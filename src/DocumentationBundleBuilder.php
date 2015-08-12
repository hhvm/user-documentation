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
    );
  }

  private static function GetClassDocs(
    ScannedClass $class,
  ): ClassDocumentation {
    if ($class->isInterface()) {
      $type = ClassType::INTERFACE_CLASS;
    } else if ($class->isTrait()) {
      $type = ClassType::TRAIT_CLASS;
    } else {
      $type = ClassType::BASIC_CLASS;
    }

    return shape(
      'name' => $class->getName(),
      'type' => $type,
      'methods' => $class
        ->getMethods()
        ->map($m ==> $m->getName())
        ->toArray(),
    );
  }
}
