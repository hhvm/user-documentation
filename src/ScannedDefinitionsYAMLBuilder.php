<?hh // strict

namespace HHVM\UserDocumentation;

use FredEmmott\DefinitionFinder\FileParser;
use FredEmmott\DefinitionFinder\ScannedClass;
use FredEmmott\DefinitionFinder\ScannedBase;
use FredEmmott\DefinitionFinder\ScannedFunctionAbstract;
use FredEmmott\DefinitionFinder\ScannedTypehint;
use FredEmmott\DefinitionFinder\ScannedGeneric;
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
      $x ==> self::GetClassDocumentation($x),
    );
    $this->buildDefinitions(
      'interface',
      $this->parser->getInterfaces(),
      $x ==> self::GetClassDocumentation($x),
    );
    $this->buildDefinitions(
      'trait',
      $this->parser->getTraits(),
      $x ==> self::GetClassDocumentation($x),
    );
    $this->buildDefinitions(
      'function',
      $this->parser->getFunctions(),
      $x ==> self::GetFunctionDocumentation($x),
    );
  }

  private function buildDefinitions<T as ScannedBase>(
    string $prefix,
    \ConstVector<T> $defs,
    (function(T):shape()) $converter,
  ): void {
    $defs = $this->filtered($defs);

    foreach ($defs as $def) {
      $data = array(
        'source' => $this->source,
        'data' => $converter($def),
      );
      file_put_contents(
        $this->getFileName($prefix, $def),
        /* UNSAFE_EXPR: no HHI for Spyc */
        \Spyc::YAMLDump($data),
      );
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

  private static function GetClassDocumentation(
    ScannedClass $class,
  ): ClassDocumentation {
    return shape(
      'name' => $class->getName(),
      'methods' => $class
        ->getMethods()
        ->map($m ==> $m->getName())
        ->toArray(),
      'generics' => $class
        ->getGenericTypes()
        ->map($gt ==> self::GetGenericDocumentation($gt))
        ->toArray(),
    );
  }

  private static function GetFunctionDocumentation(
    ScannedFunctionAbstract $function,
  ): FunctionDocumentation {
    return shape(
      'name' => $function->getName(),
      'returnType' => self::GetNullableTypehintDocumentation($function->getReturnType()),
      'generics' => $function
        ->getGenericTypes()
        ->map($gt ==> self::GetGenericDocumentation($gt))
        ->toArray(),
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

  private function getFileName(string $prefix, ScannedBase $def): string {
    $def_name = strtr($def->getName(), "\\", '.');
    if ($def instanceof HasScannedGenerics && $def->getGenericTypes()) {
      $def_name .= '.'.implode(
        '',
        $def->getGenericTypes()->map($gt ==> $gt->getName()),
      );
    }

    return sprintf(
      '%s/%s.%s.yml',
      $this->destination,
      $prefix,
      $def_name,
    );
  }
}
