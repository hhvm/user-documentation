<?hh
namespace HHVM\UserDocumentation;

use phpDocumentor\Reflection\DocBlock;
use phpDocumentor\Reflection\DocBlock\Tag;

trait DocblockTagReader {
  protected ?DocBlock $docblock;

  <<__Memoize>>
  protected function getTagsByName<T as Tag>(
    string $name,
    classname<T> $type = Tag::class,
  ): Vector<T> {
    $tags = Vector {};
    // If $this->docblock is null, passing null to Map constructor returns
    // empty map
    $raw_tags = new Map($this->docblock?->getTagsByName($name));
    foreach ($raw_tags as $tag) {
      invariant(
        $tag instanceof $type,
        'Expected %s tags to be %s, got %s',
        $name,
        $type,
        get_class($tag),
      );
      $tags[] = $tag;
    }
    
    return $tags;
  }
}
