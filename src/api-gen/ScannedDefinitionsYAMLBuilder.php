<?hh // strict

namespace HHVM\UserDocumentation;

use FredEmmott\DefinitionFinder\FileParser;
use FredEmmott\DefinitionFinder\ScannedClass;
use FredEmmott\DefinitionFinder\ScannedBase;
use FredEmmott\DefinitionFinder\ScannedFunctionAbstract;
use FredEmmott\DefinitionFinder\ScannedMethod;
use FredEmmott\DefinitionFinder\ScannedTypehint;
use FredEmmott\DefinitionFinder\ScannedGeneric;
use FredEmmott\DefinitionFinder\ScannedParameter;
use FredEmmott\DefinitionFinder\HasScannedGenerics;

class ScannedDefinitionsYAMLBuilder {
  private Vector<ScannedDefinitionFilter> $filters = Vector { };

  public function __construct(
    private DocumentationSource $source,
    private FileParser $parser,
    private string $destination,
  ) {
  }

  public function addFilter(ScannedDefinitionFilter $filter): this {
    $this->filters[] = $filter;
    return $this;
  }

  public function build(): void {
    $this->buildDefinitions(
      'class',
      $this->parser->getClasses(),
      $x ==> $this->getClassDocumentation($x),
    );
    $this->buildDefinitions(
      'interface',
      $this->parser->getInterfaces(),
      $x ==> $this->getClassDocumentation($x),
    );
    $this->buildDefinitions(
      'trait',
      $this->parser->getTraits(),
      $x ==> $this->getClassDocumentation($x),
    );
    $this->buildDefinitions(
      'function',
      $this->parser->getFunctions(),
      $x ==> $this->getFunctionDocumentation($x),
    );
  }

  private function buildDefinitions<T as ScannedBase>(
    string $prefix,
    \ConstVector<T> $defs,
    (function(T):shape('name' => string)) $converter,
  ): void {
    $defs = $this->filtered($defs);
    $writer = new YAMLWriter($this->destination);
    foreach ($defs as $def) {
      $data = shape(
        'sources' => [$this->source],
        'type' => $prefix,
        'data' => $converter($def),
      );
      $writer->write($data);
    }
  }

  private function filtered<T as ScannedBase>(
    \ConstVector<T> $list,
  ): \ConstVector<T> {
    foreach ($this->filters as $filter) {
      // https://github.com/facebook/hhvm/issues/5919
      $list = $list->filter($v ==> $filter($v));
    }
    return $list;
  }

  private function getClassDocumentation(
    ScannedClass $class,
  ): ClassDocumentation {
    return shape(
      'name' => $class->getName(),
      'methods' => $class
        ->getMethods()
        ->map($m ==> $this->getFunctionDocumentation($m))
        ->toArray(),
      'generics' => $class
        ->getGenericTypes()
        ->map($gt ==> self::GetGenericDocumentation($gt))
        ->toArray(),
      'parent' =>
        self::GetNullableTypehintDocumentation($class->getParentClassInfo()),
      'interfaces' => $class
        ->getInterfaceInfo()
        ->map($interface ==> self::GetTypehintDocumentation($interface))
        ->toArray(),
      'docComment' => $class->getDocComment(),
    );
  }

  private function getFunctionDocumentation(
    ScannedFunctionAbstract $function,
  ): FunctionDocumentation {
    $ret = shape(
      'name' => $function->getName(),
      'returnType' =>
        self::GetNullableTypehintDocumentation($function->getReturnType()),
      'generics' => $function
        ->getGenericTypes()
        ->map($gt ==> self::GetGenericDocumentation($gt))
        ->toArray(),
      'docComment' => $function->getDocComment(),
      'parameters' => $function
        ->getParameters()
        ->map($p ==> self::GetParameterDocumentation($p))
        ->toArray(),
      'visibility' => null,
      'static' => null,
    );

    if (!$function instanceof ScannedMethod) {
      return $ret;
    }

    $ret['static'] = $function->isStatic();

    if ($function->isPublic()) {
      $ret['visibility'] = MemberVisibility::PUBLIC;
    } else if ($function->isPrivate()) {
      $ret['visibility'] = MemberVisibility::PRIVATE;
    } else {
      invariant(
        $function->isProtected(),
        'method with no visibility: %s',
        var_export($function, true),
      );
      $ret['visibility'] = MemberVisibility::PROTECTED;
    }
    return $ret;
  }

  private static function GetParameterDocumentation(
    ScannedParameter $param,
  ): ParameterDocumentation {
    return shape(
      'name' => $param->getName(),
      'typehint' =>
        self::GetNullableTypehintDocumentation($param->getTypehint()),
      'isVariadic' => $param->isVariadic(),
      'isPassedByReference' => $param->isPassedByReference(),
      'isOptional' => $param->isOptional(),
      'default' =>
        $param->isOptional() ? $param->getDefaultString() : null,
    );
  }

  private static function GetGenericDocumentation(
    ScannedGeneric $g,
  ): GenericDocumentation {
    return shape(
      'name' => $g->getName(),
      'constraint' => $g->getConstraintTypeName(),
    );
  }

  private static function GetTypehintDocumentation(
    ScannedTypehint $typehint,
  ): TypehintDocumentation {
    return shape(
      'typename' => $typehint->getTypeName(),
      'genericTypes' =>
        $typehint
        ->getGenericTypes()
        ->map($th ==> self::GetTypehintDocumentation($th))
        ->toArray(),
    );
  }

  private static function GetNullableTypehintDocumentation(
    ?ScannedTypehint $typehint,
  ): ?TypehintDocumentation {
    if ($typehint === null) {
      return null;
    }
    return self::GetTypehintDocumentation($typehint);
  }
}
