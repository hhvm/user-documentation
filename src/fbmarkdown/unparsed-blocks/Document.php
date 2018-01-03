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

namespace Facebook\Markdown\UnparsedBlocks;

use type Facebook\Markdown\Blocks\Document as ASTNode;
use namespace Facebook\Markdown\Inlines;
use namespace HH\Lib\Vec;

class Document extends ContainerBlock<Block> implements BlockProducer {
  public static function consume(
    Context $context,
    Lines $lines,
  ): (Document, Lines) {
    return tuple(
      new self(self::consumeChildren($context, $lines)),
      new Lines(vec[]),
    );
  }

  <<__Override>>
  public function withParsedInlines(Inlines\Context $ctx): ASTNode {
    return new ASTNode(
      Vec\map(
        $this->children,
        $child ==> $child->withParsedInlines($ctx),
      ),
    );
  }
}
