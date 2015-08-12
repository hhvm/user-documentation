<?hh // strict

namespace HHVM\UserDocumentation;

use FredEmmott\DefinitionFinder\FileParser;
use FredEmmott\DefinitionFinder\ScannedClass;

class DocumentationBundleBuilder {
  public function __construct(
    private DocumentationSource $source,
    private FileParser $parser,
  ) {
  }

  public function toBundle(): DocumentationBundle {
    return shape(
      'source' => $this->source,
      'classes' => $this->parser
        ->getClasses()
        ->map($x ==> self::GetClassDocs($x))
        ->toArray(),
      'interfaces' => $this->parser
        ->getInterfaces()
        ->map($x ==> self::GetClassDocs($x))
        ->toArray(),
      'traits' => $this->parser
        ->getTraits()
        ->map($x ==> self::GetClassDocs($x))
        ->toArray(),
    );
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
