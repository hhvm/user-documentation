<?hh // strict
/*
 *  Copyright (c) 2004-present, Facebook, Inc.
 *  All rights reserved.
 *
 *  This source code is licensed under the BSD-style license found in the
 *  LICENSE file in the root directory of this source tree. An additional grant
 *  of patent rights can be found in the PATENTS file in the same directory.
 *
 */
namespace HHVM\UserDocumentation;

use phpDocumentor\Reflection\DocBlock;
use phpDocumentor\Reflection\DocBlock\Tag\ParamTag;
use phpDocumentor\Reflection\DocBlock\Tag;

use namespace Facebook\TypeAssert;

final class DocblockTagReader {
  private function __construct(
    private ?DocBlock $docblock,
  ) {
  }

  public static function newFromObject(
    ?DocBlock $docblock,
  ): DocblockTagReader {
    return new DocblockTagReader($docblock);
  }

  public static function newFromString(
    ?string $docblock,
  ): DocblockTagReader {
    if ($docblock === null) {
      return new DocblockTagReader(null);
    }
    return new DocblockTagReader(new DocBlock($docblock));
  }

  public function getTagsByName(
    string $name,
  ): Vector<Tag> {
    return $this->getTypedTagsByName(
      $name,
      Tag::class,
    );
  }

  <<__Memoize>>
  public function getTypedTagsByName<T as Tag>(
    string $name,
    classname<T> $type,
  ): Vector<T> {
    $tags = Vector {};
    // If $this->docblock is null, passing null to Map constructor returns
    // empty map
    $raw_tags = new Map($this->docblock?->getTagsByName($name));
    foreach ($raw_tags as $tag) {
      $tags[] = TypeAssert\instance_of($type, $tag);
    }

    return $tags;
  }

  public function getParamTags(): Map<string, ParamTag> {
    $tags_vec = $this->getTypedTagsByName('param', ParamTag::class);
    $tags = Map { };
    foreach ($tags_vec as $tag) {
      $tags[$tag->getVariableName()] = $tag;
    }
    return $tags;
  }
}
