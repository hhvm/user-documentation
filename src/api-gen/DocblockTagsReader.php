<?hh // strict
namespace HHVM\UserDocumentation;

use phpDocumentor\Reflection\DocBlock;
use phpDocumentor\Reflection\DocBlock\Tag;

trait DocblockTagReader {
  protected ?DocBlock $docblock;

  protected function getTagsByName(
    string $name,
  ): Vector<Tag> {
    return $this->getTypedTagsByName(
      $name,
      Tag::class,
    );
  }

  <<__Memoize>>
  protected function getTypedTagsByName<T as Tag>(
    string $name,
    classname<T> $type,
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
