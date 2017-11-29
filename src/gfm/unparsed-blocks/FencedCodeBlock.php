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

use type Facebook\GFM\Blocks\FencedCodeBlock as ASTNode;
use namespace Facebook\GFM\Inlines;
use namespace HH\Lib\{C, Str, Vec};

final class FencedCodeBlock extends FencedBlock {
  const string PATTERN = '/^ {0,3}(?<fence>`{3,}|~{3,})([^`]*)?$/';
  private string $content;

  protected function __construct(
    vec<string> $lines,
  ) {
    $this->content = $lines
      |> Vec\slice($$, 1, C\count($lines) - 2)
      |> Str\join($$, "\n");
    parent::__construct($lines);
  }
  <<__Override>>
  protected static function getEndPatternForFirstLine(string $first): ?string {
    $matches = [];
    $result = \preg_match(self::PATTERN, $first, $matches);
    if ($result !== 1) {
      return null;
    }
    return '/^ {0,3}'.$matches['fence'].'+ *$/';
  }

  <<__Override>>
  public function withParsedInlines(Inlines\Context $_): ASTNode {
    return new ASTNode($this->content);
  }
}
