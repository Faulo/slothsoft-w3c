<?php
declare(strict_types = 1);
namespace w3c;

class InterfaceGenerator {

    private const NAMESPACE_SEPARATOR = '\\';

    public $includeExcecptons = false;

    private $moduleName;

    private $interfaceURI;

    private $interfaceNS = [];

    private $interfacePath;

    private $classNS = [];

    private $classPath;

    private $interfaceList;

    private $currentInterface;

    private $phpProlog = '<' . '?php' . PHP_EOL . 'declare(strict_types = 1);';

    // chr(239) . chr(187) . chr(191);
    private $phpExtension = '.php';

    public function __construct(InterfaceModule $module) {
        $this->moduleName = $module->moduleName;
        $this->interfaceURI = $module->interfaceURI;

        $this->interfacePath = dirname(__FILE__) . DIRECTORY_SEPARATOR;
        $this->classPath = realpath($module->classDirectory) . DIRECTORY_SEPARATOR;

        if ($module->moduleName) {
            $this->interfaceNS = explode('.', $module->moduleName);
        }
        if ($module->classNS) {
            $this->classNS = explode('.', $module->classNS);
        }
        foreach ($this->interfaceNS as $ns) {
            $this->interfacePath .= $ns . DIRECTORY_SEPARATOR;
        }
        foreach ($this->classNS as $ns) {
            $this->classPath .= $ns . DIRECTORY_SEPARATOR;
        }

        if (! is_dir($this->interfacePath)) {
            mkdir($this->interfacePath, 0777, true);
        }
        if (! is_dir($this->classPath)) {
            mkdir($this->classPath, 0777, true);
        }

        array_unshift($this->interfaceNS, 'w3c');

        $this->loadInterfaces();
    }

    private function loadInterfaces() {
        $this->interfaceList = [];
        $doc = new \DOMDocument();
        $doc->loadHTMLFile($this->interfaceURI);
        $xpath = new \DOMXPath($doc);
        $pres = $doc->getElementsByTagName('pre');
        foreach ($pres as $pre) {
            $href = $xpath->evaluate('string(.//a/@href)', $pre);
            $href = dirname($this->interfaceURI) . '/' . $href;
            $this->createInterface($pre->textContent, $href);
        }
    }

    public function writeInterfaces() {
        ksort($this->interfaceList);
        foreach ($this->interfaceList as $interface) {
            $name = $interface['name'];

            $interfaceBase = self::NAMESPACE_SEPARATOR;
            foreach ($this->interfaceNS as $ns) {
                $interfaceBase .= $ns . self::NAMESPACE_SEPARATOR;
            }
            $interfaceName = $interfaceBase . $name;

            $className = self::NAMESPACE_SEPARATOR;
            foreach ($this->classNS as $ns) {
                $className .= $ns . self::NAMESPACE_SEPARATOR;
            }
            $className .= $name;

            $implements = ' implements ' . $interfaceName;

            if ($interface['parent']) {
                $extends = ' extends ' . $interface['parent'];
            } else {
                $extends = '';
            }

            // INTERFACE
            $desc = [];
            $desc[] = $name;
            if (strpos($interface['href'], 'http') === 0) {
                $desc[] = '';
                $desc[] = sprintf('@link %s', $interface['href']);
            }
            $codeList = [];
            $codeList[] = $this->phpProlog;
            $codeList[] = $this->createComment($desc);
            if ($this->interfaceNS) {
                $codeList[] = sprintf('namespace %s;', implode(self::NAMESPACE_SEPARATOR, $this->interfaceNS));
            }
            $codeList[] = '';
            $codeList[] = sprintf('interface %s {', $name . $extends);
            if ($interface['const']) {
                $codeList[] = '';
                foreach ($interface['const'] as $code) {
                    $codeList[] = "\t" . str_replace(PHP_EOL, PHP_EOL . "\t", $code);
                }
            }
            if ($interface['attr']) {
                foreach ($interface['attr'] as $code) {
                    $codeList[] = '';
                    $codeList[] = "\t" . str_replace(PHP_EOL, PHP_EOL . "\t", $code);
                }
            }
            if ($interface['func']) {
                foreach ($interface['func'] as $code) {
                    $codeList[] = '';
                    $codeList[] = "\t" . str_replace(PHP_EOL, PHP_EOL . "\t", $code);
                }
            }
            $codeList[] = '}';

            $code = implode(PHP_EOL, $codeList);

            // echo $code . PHP_EOL . PHP_EOL;
            $path = $this->interfacePath . $name . $this->phpExtension;
            printf('Creating Interface %s (%s)...%s', $interfaceName, $path, PHP_EOL);
            file_put_contents($path, $code);

            // CLASS
            $desc = [];
            $desc[] = $name;
            $desc[] = '';
            $desc[] = sprintf('@link %s', $interface['href']);
            $codeList = [];
            $codeList[] = $this->phpProlog;
            $codeList[] = $this->createComment($desc);
            if ($this->classNS) {
                $codeList[] = sprintf('namespace %s;', implode(self::NAMESPACE_SEPARATOR, $this->classNS));
            }
            $codeList[] = '';
            $codeList[] = sprintf('class %s {', $name . $extends . $implements);
            if ($interface['const']) {
                $codeList[] = '';
                $codeList[] = '/*';
                foreach ($interface['const'] as $code) {
                    $codeList[] = "\t" . str_replace(PHP_EOL, PHP_EOL . "\t", $code);
                }
                $codeList[] = '*/';
            }
            if ($interface['attr']) {
                foreach ($interface['attr'] as $code) {
                    $code = str_replace(';', implode(PHP_EOL, [
                        ' {',
                        "\t",
                        '}'
                    ]), $code);
                    $codeList[] = '';
                    $codeList[] = "\t" . str_replace(PHP_EOL, PHP_EOL . "\t", $code);
                }
            }
            if ($interface['func']) {
                foreach ($interface['func'] as $code) {
                    $code = str_replace(';', implode(PHP_EOL, [
                        ' {',
                        "\t",
                        '}'
                    ]), $code);
                    $code = preg_replace([
                        '/\(([[:alpha:]]+) /',
                        '/, ([[:alpha:]]+) /'
                    ], [
                        '(' . preg_quote($interfaceBase) . '$1 ',
                        ', ' . preg_quote($interfaceBase) . '$1 '
                    ], $code);
                    $codeList[] = '';
                    $codeList[] = "\t" . str_replace(PHP_EOL, PHP_EOL . "\t", $code);
                }
            }
            $codeList[] = '}';

            $code = implode(PHP_EOL, $codeList);

            // echo $code . PHP_EOL . PHP_EOL;
            $path = $this->classPath . $name . $this->phpExtension;
            printf('Creating Class %s (%s)...%s', $className, $path, PHP_EOL);
            file_put_contents($path, $code);
        }
    }

    private function createInterface($wholeText, $href) {
        if (strpos($wholeText, 'interface') !== false) {
            $match = [];
            if (preg_match('/interface (\w+)\s*:?\s*(\w*)\s{/', $wholeText, $match)) {
                $this->currentInterface = $match[1];
                $interface = [];
                $interface['name'] = $this->currentInterface;
                $interface['parent'] = $match[2];
                $interface['href'] = $href;
                $interface['const'] = [];
                $interface['attr'] = [];
                $interface['func'] = [];
                $wholeText = str_replace($match[0], '', $wholeText);

                $textList = explode("\n", trim($wholeText));
                $lastText = null;
                foreach ($textList as &$text) {
                    $text = trim(preg_replace('/\s+/', ' ', $text));
                    if (strpos($text, '// raises') === 0) {
                        if ($lastText) {
                            $lastText = substr($lastText, 0, - 1) . $text . ';';
                            $text = '';
                        }
                    }
                    if (strpos($text, '//') === 0) {
                        $text = '';
                    }
                    if (strpos($text, '}') === 0) {
                        $text = '';
                    }
                    if (strlen($text)) {
                        unset($lastText);
                        $lastText = &$text;
                    }
                }
                unset($text);
                $wholeText = implode(PHP_EOL, $textList);
                $wholeText = preg_replace('/\s+/', ' ', trim($wholeText));
                $textList = explode(';', $wholeText);
                foreach ($textList as &$text) {
                    $text = trim($text);
                    if (strlen($text)) {
                        if (preg_match('/([\w\s]+)(.*)/', $text, $match)) {
                            $left = trim($match[1]);
                            $right = trim($match[2]);
                            $arr = explode(' ', $left);
                            $attr = [];
                            foreach ($arr as $val) {
                                $attr[$val] = $val;
                            }
                            if (isset($attr['const'])) {
                                // CONSTANT
                                $name = array_pop($attr);

                                $interface['const'][] = sprintf('const %s %s;', $name, $right);
                            } elseif (isset($attr['attribute'])) {
                                // ATTRIBUTE
                                if (preg_match('/\(([^)]*)\) on setting/', $right, $match)) {
                                    $setException = explode(', ', $match[1]);
                                } else {
                                    $setException = [];
                                }
                                if (preg_match('/\(([^)]*)\) on retrieval/', $right, $match)) {
                                    $getException = explode(', ', $match[1]);
                                } else {
                                    $getException = [];
                                }
                                $name = array_pop($arr);
                                $func = $name;
                                $func[0] = strtoupper($func[0]);
                                $type = [];
                                while (count($arr)) {
                                    if (end($arr) === 'attribute') {
                                        break;
                                    }
                                    $type[] = array_pop($arr);
                                }
                                $type = implode(' ', $type);
                                $type = $this->createType($type);
                                $interface['attr'][] = $this->createFunction('get' . $func, $type, [], $setException);
                                if (! isset($attr['readonly'])) {
                                    $interface['attr'][] = $this->createFunction('set' . $func, 'void', [
                                        $name => $type
                                    ], $getException);
                                }
                            } else {
                                // FUNCTION
                                $name = array_pop($arr);
                                $type = implode(' ', $arr);
                                $type = $this->createType($type);
                                if (preg_match('/\((.*?)\)/', $right, $match)) {
                                    $exception = str_replace($match[0], '', $right);
                                    $paramList = $this->createParam($match[1]);
                                    if (preg_match('/\((.*?)\)/', $exception, $match)) {
                                        $exception = explode(', ', $match[1]);
                                    } else {
                                        $exception = [];
                                    }
                                    $interface['func'][] = $this->createFunction($name, $type, $paramList, $exception);
                                } else {
                                    my_dump($right);
                                    die();
                                }
                            }
                        }
                    }
                }
                if ($interface['name'] === $this->createType($interface['name'])) {
                    $this->interfaceList[$interface['name']] = $interface;
                }
            } else {
                die($text);
            }
        }
    }

    private static $typeList = [];

    private function createType($type) {
        switch ($type) {
            case 'Attr':
            case 'CDATASection':
            case 'CharacterData':
            case 'Comment':
            case 'DOMConfiguration':
            case 'DOMImplementation':
            case 'Document':
            case 'DocumentFragment':
            case 'DocumentType':
            case 'Element':
            case 'Entity':
            case 'EntityReference':
            case 'Node':
            case 'Notation':
            case 'ProcessingInstruction':
            case 'Text':
            case 'TypeInfo':
            case 'UserDataHandler':
            case 'XPathEvaluator':
            case 'XPathExpression':
            case 'XPathNSResolver':
            case 'XPathNamespace':
            case 'XPathResult':
                break;
            case 'DOMObject':
                switch ($this->currentInterface) {
                    case 'DOMImplementation':
                        $type = 'DOMImplementation';
                        break;
                    case 'Node':
                        $type = 'Node';
                        break;
                    case 'XPathEvaluator':
                    case 'XPathExpression':
                        $type = 'XPathResult';
                        break;
                }
                break;
            case 'DOMImplementationSource':
                $type = 'DOMImplementation';
                break;
            case 'DOMUserData':
                $type = 'Object';
                break;
            case 'DOMStringList':
            case 'NodeList':
            case 'DOMImplementationList':
            case 'NameList':
            case 'NamedNodeMap':
                $type = 'array';
                break;
            case 'DOMString':
                $type = 'string';
                break;
            case 'boolean':
                $type = 'bool';
                break;
            case 'double':
                $type = 'float';
                break;
            case 'long':
            case 'long unsigned':
            case 'short unsigned':
            case 'unsigned long':
            case 'unsigned short':
                $type = 'int';
                break;
            case 'DOMError':
            case 'DOMErrorHandler':
            case 'DOMLocator':
                $type = '';
                break;
        }
        self::$typeList[$type] = true;
        return $type;
    }

    private function createParam($code) {
        $paramList = [];
        if (strlen($code)) {
            $code = explode(',', $code);
            foreach ($code as $c) {
                $c = trim($c);
                $arr = explode(' ', $c);
                $in = array_shift($arr);
                if ($in !== 'in') {
                    my_dump($code);
                }
                $name = array_pop($arr);
                $type = implode(' ', $arr);
                $type = $this->createType($type);

                $paramList[$name] = $type;
            }
        }
        return $paramList;
    }

    private function createFunction($functionName, $returnType, array $paramList = [], array $exceptionList = []) {
        $desc = [];
        $arr = [];
        foreach ($paramList as $name => $type) {
            $desc[] = sprintf('@param %s $%s', $type, $name);
            $param = sprintf('%s $%s', $type, $name);
            $arr[] = $param;
        }
        $param = implode(', ', $arr);
        if ($this->includeExcecptons) {
            foreach ($exceptionList as $exception) {
                $desc[] = sprintf('@throws %s', $exception);
            }
        }
        $desc[] = sprintf('@return %s', $returnType);
        $desc = $this->createComment($desc);
        return $desc . sprintf('public function %s(%s) : %s;', $functionName, $param, $returnType);
    }

    private function createComment(array $desc) {
        foreach ($desc as &$d) {
            $d = ' * ' . $d;
        }
        unset($d);
        return '/**' . PHP_EOL . implode(PHP_EOL, $desc) . PHP_EOL . ' */' . PHP_EOL;
    }

    private function interface2class($code) {
        $code = preg_replace(array(
            '/^interface ([[:alpha:]]+) extends ([[:alpha:]]+)/',
            '/^interface ([[:alpha:]]+)/',
            '/\t\/\/Constants\n/',
            '/\tconst.+;\n/',
            '/;/',
            '/\(([[:alpha:]]+) /',
            '/, ([[:alpha:]]+) /'
        ), array(
            'class $1 extends $2 implements ' . preg_quote($this->NS) . '$1',
            'class $1 implements ' . preg_quote($this->NS) . '$1',
            '',
            '',
            ' {
		
	}',
            '(' . preg_quote($this->NS) . '$1 ',
            ', ' . preg_quote($this->NS) . '$1 '
        ), $code);
        return $code;
    }
}