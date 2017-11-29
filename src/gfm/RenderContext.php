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

use namespace HH\Lib\Vec;

final class RenderContext {
  const type TFilter = (function(RenderContext, ASTNode): bool);
  const type TTransform = (function(RenderContext, ASTNode): vec<ASTNode>);

  private vec<self::TTransform> $transformations = vec[];

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
