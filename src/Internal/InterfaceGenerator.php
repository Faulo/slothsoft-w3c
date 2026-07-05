<?php
declare(strict_types = 1);

namespace w3c\Internal;

use DOMDocument;
use DOMElement;
use DOMXPath;

class InterfaceGenerator {
    
    private const EOL = "\n";
    
    private const NAMESPACE_SEPARATOR = '\\';
    
    private string $interfaceURI;
    
    private string $sourceURI;
    
    /**
     * @var string[]
     */
    private array $interfaceNS = [];
    
    private string $interfacePath;
    
    private bool $generateAttributeAccessors;
    
    /**
     * @var array<string,array<string,mixed>>
     */
    private array $interfaceList = [];
    
    private string $phpProlog = '<?php' . self::EOL . 'declare(strict_types = 1);';
    
    private string $phpExtension = '.php';
    
    public function __construct(InterfaceModule $module) {
        $this->interfaceURI = $module->interfaceURI;
        $this->sourceURI = $module->interfaceURI;
        $this->generateAttributeAccessors = $module->generateAttributeAccessors;
        
        $this->interfacePath = dirname(__DIR__) . DIRECTORY_SEPARATOR;
        
        if ($module->moduleName !== '') {
            $this->interfaceNS = explode('.', $module->moduleName);
        }
        foreach ($this->interfaceNS as $ns) {
            $this->interfacePath .= $ns . DIRECTORY_SEPARATOR;
        }
        
        if (! is_dir($this->interfacePath)) {
            mkdir($this->interfacePath, 0777, true);
        }
        
        array_unshift($this->interfaceNS, 'w3c');
        $this->loadInterfaces();
    }
    
    public function writeInterfaces(): void {
        ksort($this->interfaceList);
        foreach ($this->interfaceList as $name => $interface) {
            $interfaceName = $this->createFullyQualifiedName($this->interfaceNS, $name);
            
            $interfacePath = $this->interfacePath . $name . $this->phpExtension;
            printf('Creating Interface %s (%s)...%s', $interfaceName, $interfacePath, self::EOL);
            file_put_contents($interfacePath, $this->renderInterface($interface));
        }
    }
    
    private function loadInterfaces(): void {
        $this->interfaceList = [];
        $doc = new DOMDocument();
        $previousUseInternalErrors = libxml_use_internal_errors(true);
        $doc->loadHTMLFile($this->interfaceURI);
        libxml_clear_errors();
        libxml_use_internal_errors($previousUseInternalErrors);
        
        foreach ($doc->getElementsByTagName('pre') as $pre) {
            assert($pre instanceof DOMElement);
            foreach ($this->extractInterfaceBlocks($pre->textContent) as $block) {
                $href = $this->createHref($doc, $pre, $this->extractInterfaceName($block));
                $this->createInterface($block, $href);
            }
        }
    }
    
    /**
     * @return string[]
     */
    private function extractInterfaceBlocks(string $text): array {
        $text = html_entity_decode($text, ENT_QUOTES | ENT_HTML5);
        $text = preg_replace('/\r\n?/', "\n", $text);
        assert(is_string($text));
        
        $blocks = [];
        if (preg_match_all('/((?:partial\s+)?interface\s+\w+(?:\s*:\s*\w+)?\s*\{.*?};)/s', $text, $matches)) {
            foreach ($matches[1] as $block) {
                $blocks[] = $block;
            }
        }
        return $blocks;
    }
    
    private function extractInterfaceName(string $block): string {
        if (preg_match('/(?:partial\s+)?interface\s+(\w+)/', $block, $match)) {
            return $match[1];
        }
        return '';
    }
    
    private function createHref(DOMDocument $doc, DOMElement $pre, string $preferredText): string {
        $xpath = new DOMXPath($doc);
        $href = '';
        if ($preferredText !== '') {
            $literal = $this->createXPathLiteral($preferredText);
            $href = trim((string) $xpath->evaluate(sprintf('string(.//a[normalize-space(.) = %s]/@href)', $literal), $pre));
            if ($href === '') {
                $id = trim((string) $xpath->evaluate(sprintf('string(.//dfn[normalize-space(.) = %s]/@id)', $literal), $pre));
                if ($id !== '') {
                    $href = '#' . $id;
                }
            }
        }
        if ($href === '') {
            $href = trim((string) $xpath->evaluate('string(.//a/@href)', $pre));
        }
        if ($href === '') {
            return $this->sourceURI;
        }
        if (strpos($href, 'http://') === 0 || strpos($href, 'https://') === 0) {
            return $href;
        }
        if (strpos($href, '#') === 0) {
            return $this->sourceURI . $href;
        }
        return dirname($this->sourceURI) . '/' . $href;
    }
    
    private function createXPathLiteral(string $value): string {
        if (strpos($value, "'") === false) {
            return "'" . $value . "'";
        }
        if (strpos($value, '"') === false) {
            return '"' . $value . '"';
        }
        $parts = explode("'", $value);
        foreach ($parts as &$part) {
            $part = "'" . $part . "'";
        }
        unset($part);
        return 'concat(' . implode(', "\'", ', $parts) . ')';
    }
    
    private function createInterface(string $wholeText, string $href): void {
        if (! preg_match('/^(partial\s+)?interface\s+(\w+)(?:\s*:\s*(\w+))?\s*\{(.*)};$/s', trim($wholeText), $match)) {
            return;
        }
        
        $currentInterface = $match[2];
        if ($currentInterface === 'EventListener') {
            return;
        }
        $interface = [
            'name' => $currentInterface,
            'parent' => isset($match[3]) ? trim($match[3]) : '',
            'href' => $href,
            'const' => [],
            'methods' => []
        ];
        
        foreach ($this->splitDeclarations($match[4]) as $declaration) {
            $this->addDeclaration($interface, $declaration);
        }
        
        if (! isset($this->interfaceList[$interface['name']])) {
            $this->interfaceList[$interface['name']] = $interface;
            return;
        }
        
        $this->interfaceList[$interface['name']]['const'] += $interface['const'];
        foreach ($interface['methods'] as $method) {
            $this->addMethod($this->interfaceList[$interface['name']], $method);
        }
    }
    
    /**
     * @return string[]
     */
    private function splitDeclarations(string $body): array {
        $body = preg_replace('/\/\*.*?\*\//s', '', $body);
        $body = preg_replace('/^\s*\/\/.*$/m', '', (string) $body);
        $body = preg_replace('/\s*raises\s*\([^)]*\)/i', '', (string) $body);
        assert(is_string($body));
        
        $declarations = [];
        foreach (explode(';', $body) as $declaration) {
            $declaration = trim(preg_replace('/\s+/', ' ', $declaration));
            if ($declaration !== '') {
                $declarations[] = $declaration;
            }
        }
        return $declarations;
    }
    
    /**
     * @param array<string,mixed> $interface
     */
    private function addDeclaration(array &$interface, string $declaration): void {
        $declaration = trim(preg_replace('/\[[^]]+]\s*/', '', $declaration));
        if ($declaration === '' || strpos($declaration, 'constructor(') === 0 || strpos($declaration, 'callback ') === 0) {
            return;
        }
        
        if (preg_match('/^const\s+(.+?)\s+(\w+)\s*=\s*(.+)$/s', $declaration, $match)) {
            $interface['const'][$match[2]] = [
                'name' => $match[2],
                'value' => trim($match[3])
            ];
            return;
        }
        
        if (preg_match('/^(readonly\s+)?attribute\s+(.+?)\s+(\w+)$/s', $declaration, $match)) {
            if ($this->generateAttributeAccessors) {
                $type = $this->createTypeInfo($match[2]);
                $methodSuffix = ucfirst($match[3]);
                $this->addMethod($interface, [
                    'name' => 'get' . $methodSuffix,
                    'static' => false,
                    'params' => [],
                    'returnNative' => $type['native'],
                    'returnDoc' => $type['doc']
                ]);
                if (trim($match[1]) === '') {
                    $this->addMethod($interface, [
                        'name' => 'set' . $methodSuffix,
                        'static' => false,
                        'params' => [
                            [
                                'name' => 'value',
                                'native' => $type['native'],
                                'doc' => $type['doc'],
                                'default' => null
                            ]
                        ],
                        'returnNative' => 'void',
                        'returnDoc' => 'void'
                    ]);
                }
            }
            return;
        }
        
        $declaration = preg_replace('/^(getter|setter|creator|deleter|legacycaller)\s+/i', '', $declaration);
        assert(is_string($declaration));
        if (preg_match('/^(static\s+)?(.+?)\s+(\w+)\s*\((.*)\)$/s', $declaration, $match)) {
            $returnType = $this->createTypeInfo($match[2]);
            $this->addMethod($interface, [
                'name' => $match[3],
                'static' => trim($match[1]) !== '',
                'params' => $this->createParam($match[4]),
                'returnNative' => $returnType['native'],
                'returnDoc' => $returnType['doc']
            ]);
        }
    }
    
    /**
     * @param array<string,mixed> $interface
     * @param array<string,mixed> $method
     */
    private function addMethod(array &$interface, array $method): void {
        if (! isset($interface['methods'][$method['name']])) {
            $interface['methods'][$method['name']] = $method;
            return;
        }
        $interface['methods'][$method['name']] = $this->mergeMethodOverload($interface['methods'][$method['name']], $method);
    }
    
    /**
     * @param array<string,mixed> $current
     * @param array<string,mixed> $method
     * @return array<string,mixed>
     */
    private function mergeMethodOverload(array $current, array $method): array {
        $params = [];
        $count = max(count($current['params']), count($method['params']));
        for ($i = 0; $i < $count; $i++) {
            $params[] = $this->mergeParamOverload($current['params'][$i] ?? null, $method['params'][$i] ?? null);
        }
        $current['params'] = $params;
        $current['static'] = $current['static'] || $method['static'];
        $current['returnNative'] = $this->mergeNativeType($current['returnNative'], $method['returnNative']);
        $current['returnDoc'] = $this->mergeDocTypes($current['returnDoc'], $method['returnDoc']);
        return $current;
    }
    
    /**
     * @param array<string,mixed>|null $current
     * @param array<string,mixed>|null $method
     * @return array<string,mixed>
     */
    private function mergeParamOverload(?array $current, ?array $method): array {
        if ($current === null) {
            assert($method !== null);
            $method['default'] = $method['default'] ?? 'null';
            $method['native'] = '';
            $method['doc'] = $this->mergeDocTypes($method['doc'], 'null');
            return $method;
        }
        if ($method === null) {
            $current['default'] = $current['default'] ?? 'null';
            $current['native'] = '';
            $current['doc'] = $this->mergeDocTypes($current['doc'], 'null');
            return $current;
        }
        return [
            'name' => $current['name'],
            'native' => $this->mergeNativeType($current['native'], $method['native']),
            'doc' => $this->mergeDocTypes($current['doc'], $method['doc']),
            'default' => $current['default'] ?? $method['default']
        ];
    }
    
    private function mergeNativeType(string $left, string $right): string {
        return $left === $right ? $left : '';
    }
    
    private function mergeDocTypes(string $left, string $right): string {
        $types = [];
        foreach (explode('|', $left . '|' . $right) as $type) {
            $type = trim($type);
            if ($type !== '') {
                $types[$type] = $type;
            }
        }
        return implode('|', $types);
    }
    
    /**
     * @return array<int,array<string,mixed>>
     */
    private function createParam(string $code): array {
        $paramList = [];
        foreach ($this->splitCommaSeparated($code) as $paramCode) {
            $paramCode = trim(preg_replace('/\[[^]]+]\s*/', '', $paramCode));
            if ($paramCode === '') {
                continue;
            }
            $optional = preg_match('/^optional\s+/i', $paramCode) === 1;
            $paramCode = preg_replace('/^optional\s+/i', '', $paramCode);
            $paramCode = preg_replace('/^in\s+/i', '', (string) $paramCode);
            assert(is_string($paramCode));
            
            $default = null;
            if (preg_match('/^(.+?)\s*=\s*(.+)$/', $paramCode, $match)) {
                $paramCode = trim($match[1]);
                $default = $this->createDefaultValue(trim($match[2]));
            } elseif ($optional) {
                $default = 'null';
            }
            
            if (preg_match('/^(.+?)\s+(\w+)$/', $paramCode, $match)) {
                $type = $this->createTypeInfo($match[1]);
                if ($default === 'null') {
                    $type = $this->makeNullableType($type);
                }
                $paramList[] = [
                    'name' => $match[2],
                    'native' => $type['native'],
                    'doc' => $type['doc'],
                    'default' => $default
                ];
            }
        }
        return $paramList;
    }
    
    /**
     * @return string[]
     */
    private function splitCommaSeparated(string $code): array {
        $parts = [];
        $current = '';
        $depth = 0;
        $length = strlen($code);
        for ($i = 0; $i < $length; $i++) {
            $char = $code[$i];
            if ($char === '(' || $char === '<' || $char === '[') {
                $depth++;
            } elseif (($char === ')' || $char === '>' || $char === ']') && $depth > 0) {
                $depth--;
            } elseif ($char === ',' && $depth === 0) {
                $parts[] = $current;
                $current = '';
                continue;
            }
            $current .= $char;
        }
        if (trim($current) !== '') {
            $parts[] = $current;
        }
        return $parts;
    }
    
    /**
     * @param array<string,string> $type
     * @return array<string,string>
     */
    private function makeNullableType(array $type): array {
        if ($type['native'] !== '' && $type['native'] !== 'array' && $type['native'] !== 'void' && strpos($type['native'], '?') !== 0) {
            $type['native'] = '?' . $type['native'];
        }
        $type['doc'] = $this->mergeDocTypes($type['doc'], 'null');
        return $type;
    }
    
    private function createDefaultValue(string $value): string {
        $lower = strtolower(trim($value));
        if ($lower === 'null' || $lower === 'true' || $lower === 'false') {
            return $lower;
        }
        if ($value === '""' || $value === "''" || is_numeric($value)) {
            return $value;
        }
        return 'null';
    }
    
    /**
     * @return array<string,string>
     */
    private function createTypeInfo(string $type): array {
        $type = trim(preg_replace('/\s+/', ' ', $type));
        $nullable = false;
        if (substr($type, -1) === '?') {
            $nullable = true;
            $type = substr($type, 0, -1);
        }
        $type = trim($type);
        
        if (preg_match('/^\(.+\)$/', $type)) {
            return [
                'native' => '',
                'doc' => 'mixed'
            ];
        }
        if (strpos($type, '::') !== false) {
            return [
                'native' => 'object',
                'doc' => 'object'
            ];
        }
        if (preg_match('/^sequence<(.+)>$/i', $type, $match)) {
            return [
                'native' => 'array',
                'doc' => $this->createTypeInfo($match[1])['doc'] . '[]'
            ];
        }
        
        $native = $this->mapNativeType($type);
        $doc = $this->mapDocType($type, $native);
        $typeInfo = [
            'native' => $native,
            'doc' => $doc
        ];
        return $nullable ? $this->makeNullableType($typeInfo) : $typeInfo;
    }
    
    private function mapNativeType(string $type): string {
        switch ($type) {
            case 'DOMObject':
            case 'DOMImplementationSource':
            case 'DOMImplementation':
            case 'DOMUserData':
            case 'Object':
            case 'AbstractView':
            case 'ArrayBuffer':
            case 'ArrayBufferView':
            case 'object':
                return 'object';
            case 'Document':
                return '\DOMDocument';
            case 'DocumentFragment':
                return '\DOMDocumentFragment';
            case 'DocumentType':
                return '\DOMDocumentType';
            case 'Element':
                return '\DOMElement';
            case 'Attr':
                return '\DOMAttr';
            case 'CDATASection':
                return '\DOMCdataSection';
            case 'CharacterData':
                return '\DOMCharacterData';
            case 'Comment':
                return '\DOMComment';
            case 'Entity':
                return '\DOMEntity';
            case 'EntityReference':
                return '\DOMEntityReference';
            case 'Notation':
                return '\DOMNotation';
            case 'ProcessingInstruction':
                return '\DOMProcessingInstruction';
            case 'Text':
                return '\DOMText';
            case 'Node':
            case 'NodeList':
            case 'NamedNodeMap':
                return '\DOMNode';
            case 'DOMError':
                return '\DOMException';
            case 'Date':
                return '\DateTimeInterface';
            case 'ByteString':
            case 'DOMString':
            case 'USVString':
                return 'string';
            case 'boolean':
                return 'bool';
            case 'Function':
            case 'EventListener':
                return 'callable';
            case 'double':
            case 'float':
            case 'unrestricted double':
                return 'float';
            case 'long':
            case 'long long':
            case 'long unsigned':
            case 'short unsigned':
            case 'unsigned long':
            case 'unsigned long long':
            case 'unsigned short':
                return 'int';
            case 'any':
                return '';
            case 'void':
            case 'undefined':
                return 'void';
            default:
                return $this->isKnownInterfaceType($type) ? $type : '';
        }
    }
    
    private function mapDocType(string $type, string $native): string {
        if ($native !== '' && $native !== 'void') {
            return $this->isKnownInterfaceType($native) ? $this->renderInterfaceType($native, false) : $native;
        }
        switch ($type) {
            case 'any':
                return 'mixed';
            case 'void':
            case 'undefined':
                return 'void';
            default:
                return $type !== '' ? $type : 'mixed';
        }
    }
    
    private function renderInterface(array $interface): string {
        $uses = $this->createInterfaceUses($interface);
        $codeList = [
            $this->phpProlog,
            sprintf('namespace %s;', implode(self::NAMESPACE_SEPARATOR, $this->interfaceNS))
        ];
        foreach ($uses as $use) {
            $codeList[] = sprintf('use %s;', $use);
        }
        $codeList[] = '';
        $codeList[] = $this->createInterfaceComment($interface['name'], $interface['href']);
        $extends = $interface['parent'] !== '' ? ' extends ' . $interface['parent'] : '';
        $codeList[] = sprintf('interface %s%s {', $interface['name'], $extends);
        
        foreach ($interface['const'] as $constant) {
            $codeList[] = '';
            $codeList[] = $this->indent(sprintf('public const %s = %s;', $constant['name'], $constant['value']));
        }
        foreach ($interface['methods'] as $method) {
            $codeList[] = '';
            $codeList[] = $this->indent($this->renderMethod($method, false));
        }
        $codeList[] = '}';
        return implode(self::EOL, $codeList) . self::EOL;
    }
    
    /**
     * @param array<string,mixed> $interface
     * @return string[]
     */
    private function createInterfaceUses(array $interface): array {
        $uses = [];
        if ($interface['parent'] !== '') {
            $this->addTypeUse($uses, $interface['parent']);
        }
        foreach ($interface['methods'] as $method) {
            $this->addTypeUse($uses, $method['returnNative']);
            $this->addTypeUse($uses, $method['returnDoc']);
            foreach ($method['params'] as $param) {
                $this->addTypeUse($uses, $param['native']);
                $this->addTypeUse($uses, $param['doc']);
            }
        }
        ksort($uses);
        return array_values($uses);
    }
    
    /**
     * @param array<string,string> $uses
     */
    private function addTypeUse(array &$uses, string $type): void {
        foreach (explode('|', $type) as $singleType) {
            $singleType = trim($singleType);
            if ($singleType === '') {
                continue;
            }
            if (strpos($singleType, '?') === 0) {
                $singleType = substr($singleType, 1);
            }
            if (substr($singleType, -2) === '[]') {
                $singleType = substr($singleType, 0, -2);
            }
            if ($this->isBuiltinType($singleType)) {
                continue;
            }
            if (strpos($singleType, self::NAMESPACE_SEPARATOR) === 0) {
                $className = substr($singleType, 1);
                $uses[$className] = $className;
                continue;
            }
            if (! $this->isKnownInterfaceType($singleType)) {
                continue;
            }
            $namespace = $this->getTypeNamespace($singleType);
            if ($namespace === $this->interfaceNS) {
                continue;
            }
            $namespace[] = $singleType;
            $className = implode(self::NAMESPACE_SEPARATOR, $namespace);
            $uses[$className] = $className;
        }
    }
    
    /**
     * @param array<string,mixed> $method
     */
    private function renderMethod(array $method, bool $forClass): string {
        $desc = [];
        foreach ($method['params'] as $param) {
            $desc[] = sprintf('@param %s $%s', $this->formatDocType($param['doc']), $param['name']);
        }
        if ($method['returnDoc'] !== '') {
            $desc[] = sprintf('@return %s', $this->formatDocType($method['returnDoc']));
        }
        $comment = $this->createComment($desc);
        $static = $method['static'] ? ' static' : '';
        $params = [];
        foreach ($method['params'] as $param) {
            $params[] = $this->renderParameter($param, $forClass);
        }
        $returnType = $method['returnNative'] !== '' ? ': ' . $this->renderNativeType($method['returnNative'], $forClass) : '';
        return $comment . sprintf('public%s function %s(%s)%s;', $static, $method['name'], implode(', ', $params), $returnType);
    }
    
    /**
     * @param array<string,mixed> $param
     */
    private function renderParameter(array $param, bool $forClass): string {
        $code = '';
        if ($param['native'] !== '') {
            $code .= $this->renderNativeType($param['native'], $forClass) . ' ';
        }
        $code .= '$' . $param['name'];
        if ($param['default'] !== null) {
            $code .= ' = ' . $param['default'];
        }
        return $code;
    }
    
    private function renderNativeType(string $type, bool $forClass): string {
        $nullable = '';
        if (strpos($type, '?') === 0) {
            $nullable = '?';
            $type = substr($type, 1);
        }
        if ($this->isKnownInterfaceType($type)) {
            return $nullable . $this->renderInterfaceType($type, $forClass);
        }
        if (strpos($type, self::NAMESPACE_SEPARATOR) === 0) {
            return $nullable . $this->getShortTypeName($type);
        }
        return $nullable . $type;
    }
    
    private function renderInterfaceType(string $type, bool $fullyQualified): string {
        if (! $fullyQualified) {
            return $type;
        }
        $namespace = $this->getTypeNamespace($type);
        if ($namespace === $this->interfaceNS) {
            return $type;
        }
        return $this->createFullyQualifiedName($namespace, $type);
    }
    
    private function isKnownInterfaceType(string $type): bool {
        return in_array($type, [
            'AnonXMLHttpRequest',
            'Blob',
            'DocumentEvent',
            'Event',
            'EventTarget',
            'File',
            'FileList',
            'FileReader',
            'FileReaderSync',
            'FormData',
            'MouseEvent',
            'MutationEvent',
            'UIEvent',
            'URL',
            'XMLHttpRequest',
            'XMLHttpRequestEventTarget',
            'XMLHttpRequestUpload'
        ], true);
    }
    
    /**
     * @return string[]
     */
    private function getTypeNamespace(string $type): array {
        switch ($type) {
            case 'DocumentEvent':
            case 'Event':
            case 'EventTarget':
            case 'MouseEvent':
            case 'MutationEvent':
            case 'UIEvent':
                return [
                    'w3c',
                    'dom'
                ];
            case 'Blob':
            case 'File':
            case 'FileList':
            case 'FileReader':
            case 'FileReaderSync':
            case 'URL':
                return [
                    'w3c',
                    'FileAPI'
                ];
            default:
                return [
                    'w3c'
                ];
        }
    }
    
    /**
     * @param string[] $namespace
     */
    private function createFullyQualifiedName(array $namespace, string $name): string {
        $parts = $namespace;
        $parts[] = $name;
        return self::NAMESPACE_SEPARATOR . implode(self::NAMESPACE_SEPARATOR, $parts);
    }
    
    private function createInterfaceComment(string $name, string $href): string {
        $lines = [
            $name
        ];
        if ($href !== '' && (strpos($href, 'http://') === 0 || strpos($href, 'https://') === 0)) {
            $lines[] = '';
            $lines[] = '@see ' . $href;
        }
        return $this->createComment($lines);
    }
    
    private function formatDocType(string $type): string {
        $types = [];
        foreach (explode('|', $type) as $singleType) {
            $types[] = $this->renderDocTypeName(trim($singleType));
        }
        if (count($types) !== 2 || ! in_array('null', $types, true)) {
            return implode('|', $types);
        }
        foreach ($types as $singleType) {
            if ($singleType !== 'null') {
                return '?' . $singleType;
            }
        }
        return implode('|', $types);
    }
    
    private function renderDocTypeName(string $type): string {
        if ($type === '') {
            return $type;
        }
        if (substr($type, -2) === '[]') {
            return $this->renderDocTypeName(substr($type, 0, -2)) . '[]';
        }
        if (strpos($type, '?') === 0) {
            return '?' . $this->renderDocTypeName(substr($type, 1));
        }
        if (strpos($type, self::NAMESPACE_SEPARATOR) === 0) {
            return $this->getShortTypeName($type);
        }
        if ($this->isKnownInterfaceType($type)) {
            return $this->renderInterfaceType($type, false);
        }
        return $type;
    }
    
    private function getShortTypeName(string $type): string {
        $type = trim($type, self::NAMESPACE_SEPARATOR);
        $pos = strrpos($type, self::NAMESPACE_SEPARATOR);
        return $pos === false ? $type : substr($type, $pos + 1);
    }
    
    private function isBuiltinType(string $type): bool {
        return in_array($type, [
            'array',
            'bool',
            'callable',
            'false',
            'float',
            'int',
            'mixed',
            'null',
            'object',
            'string',
            'true',
            'void'
        ], true);
    }
    
    /**
     * @param string[] $desc
     */
    private function createComment(array $desc): string {
        if ($desc === []) {
            return '';
        }
        foreach ($desc as &$d) {
            $d = $d === '' ? ' *' : ' * ' . $d;
        }
        unset($d);
        return '/**' . self::EOL . implode(self::EOL, $desc) . self::EOL . ' */' . self::EOL;
    }
    
    private function indent(string $code): string {
        return '    ' . str_replace(self::EOL, self::EOL . '    ', $code);
    }
}
