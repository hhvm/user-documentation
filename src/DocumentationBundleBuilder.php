<?hh // strict

namespace HHVM\UserDocumentation;

use FredEmmott\DefinitionFinder\FileParser;
use FredEmmott\DefinitionFinder\ScannedClass;
use FredEmmott\DefinitionFinder\ScannedBase;
use FredEmmott\DefinitionFinder\ScannedFunctionAbstract;
use FredEmmott\DefinitionFinder\ScannedTypehint;
use FredEmmott\DefinitionFinder\ScannedGeneric;

class DocumentationBundleBuilder {
  private Vector<DocumentationBundleFilter> $filters = Vector { };

  public function __construct(
    private DocumentationSource $source,
    private FileParser $parser,
  ) {
  }

  public function addFilter(DocumentationBundleFilter $filter): this {
    $this->filters[] = $filter;
    return $this;
  }

  public function toBundle(): DocumentationBundle {
    return shape(
      'source' => $this->source,
      'classes' =>
        $this->filtered($this->parser->getClasses())
        ->map($x ==> self::GetClassDocs($x))
        ->toArray(),
      'interfaces' =>
        $this->filtered($this->parser->getInterfaces())
        ->map($x ==> self::GetClassDocs($x))
        ->toArray(),
      'traits' =>
        $this->filtered($this->parser->getTraits())
        ->map($x ==> self::GetClassDocs($x))
        ->toArray(),
      'functions' =>
        $this->filtered($this->parser->getFunctions())
        ->map($x ==> self::GetFunctionDocs($x))
        ->toArray(),
    );
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

  private static function GetClassDocs(
    ScannedClass $class,
  ): ClassDocumentation {
    return shape(
      'name' => $class->getName(),
      'methods' => $class
        ->getMethods()
        ->map($m ==> $m->getName())
        ->toArray(),
    );
  }

  private static function GetFunctionDocs(
    ScannedFunctionAbstract $function,
  ): FunctionDocumentation {
    return shape(
      'name' => $function->getName(),
      'returnType' => self::GetNullableTypehintDocs($function->getReturnType()),
      'generics' => $function
        ->getGenericTypes()
        ->map($gt ==> self::GetGenericDocs($gt))
        ->toArray(),
    );
  }

  private static function GetGenericDocs(
    ScannedGeneric $g,
  ): GenericDocumentation {
    return shape(
      'name' => $g->getName(),
      'constraint' => $g->getConstraint(),
    );
  }

  private static function GetTypehintDocs(
    ScannedTypehint $typehint,
  ): TypehintDocumentation {
    return shape(
      'typename' => $typehint->getTypeName(),
      'genericTypes' =>
        $typehint
        ->getGenericTypes()
        ->map($th ==> self::GetTypehintDocs($th))
        ->toArray(),
    );
  }

  private static function GetNullableTypehintDocs(
    ?ScannedTypehint $typehint,
  ): ?TypehintDocumentation {
    if ($typehint === null) {
      return null;
    }
    return self::GetTypehintDocs($typehint);
  }
}
