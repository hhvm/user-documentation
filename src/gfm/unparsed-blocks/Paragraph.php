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

namespace Facebook\GFM\UnparsedBlocks;

use type Facebook\GFM\Blocks\Paragraph as ASTNode;
use namespace Facebook\GFM\Inlines;
use namespace HH\Lib\{C, Str, Vec};

final class Paragraph extends LeafBlock {
  public function __construct(
    private string $content,
  ) {
  }

  public static function consume(
    Context $context,
    vec<string> $lines,
  ): (Paragraph, vec<string>) {
    $matched = vec[C\firstx($lines)];

    for ($idx = 1; $idx < C\count($lines); ++$idx) {
      if ($lines[$idx] === '') {
        break;
      }
      if (
        !self::isParagraphContinuationText($context, Vec\drop($lines, $idx))
      ) {
        break;
      }
      $matched[] = $lines[$idx];
    }

    return tuple(
      new self(Str\join($matched, "\n")),
      Vec\drop($lines, C\count($matched)),
    );
  }

  public function withParsedInlines(Inlines\Context $ctx): ASTNode {
    return new ASTNode(Inlines\parse($ctx, $this->content));
  }
}
