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

use type Facebook\Markdown\Blocks\IndentedCodeBlock as ASTNode;
use namespace Facebook\Markdown\Inlines;
use namespace HH\Lib\{C, Str, Vec};

final class IndentedCodeBlock extends LeafBlock {
  public function __construct(private string $content) {
  }

  public static function consume(
    Context $_,
    Lines $lines,
  ): ?(Block, Lines) {
    list($matched, $rest) = $lines->getIndentedLinesAndRest(4);
    if ($matched->isEmpty()) {
      return null;
    }

    return tuple(
      new self($matched->toString()),
      $rest,
    );
  }

  <<__Override>>
  public function withParsedInlines(Inlines\Context $_): ASTNode {
    return new ASTNode(/* info string = */ null, $this->content);
  }
}
