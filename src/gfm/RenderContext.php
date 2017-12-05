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

namespace Facebook\GFM;

use type Facebook\GFM\UnparsedBlocks\Context as BlockContext;
use type Facebook\GFM\Inlines\Context as InlineContext;
use type Facebook\GFM\Blocks\Document as Document;

use namespace HH\Lib\Vec;

class RenderContext {
  const type TFilter = (function(RenderContext, ASTNode): bool);
  const type TTransform = (function(RenderContext, ASTNode): vec<ASTNode>);

  private vec<self::TTransform> $transformations = vec[];

  private ?Document $document;

  public function setDocument(Document $document): this {
    invariant(
      $this->document === null,
      'Call %s::resetFileData between files',
      static::class,
    );
    $this->document = $document;
    return $this;
  }

  public function getDocument(): Document {
    $doc = $this->document;
    invariant(
      $doc !== null,
      'call %s::setDocument before attempting to render',
      static::class,
    );
    return $doc;
  }

  public function resetFileData(): this {
    $this->document = null;
    return $this;
  }

  public function appendFilter(self::TFilter $filter): this {
    $this->appendTransformation(
      ($ctx, $node) ==> $filter($ctx, $node) ? vec[$node] : vec[],
    );
    return $this;
  }

  public function appendTransformation(self::TTransform $transform): this {
    $this->transformations[] = $transform;
    return $this;
  }

  public function transformNode(ASTNode $node): vec<ASTNode> {
    $nodes = vec[$node];
    foreach ($this->transformations as $transform) {
      $nodes = $nodes
        |> Vec\map($$, $node ==> $transform($this, $node))
        |> Vec\flatten($$);
    }
    return $nodes;
  }
}
