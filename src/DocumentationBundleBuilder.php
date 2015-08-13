<?hh // strict

namespace HHVM\UserDocumentation;

use FredEmmott\DefinitionFinder\FileParser;
use FredEmmott\DefinitionFinder\ScannedClass;
use FredEmmott\DefinitionFinder\ScannedBase;

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
}
