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

use type Facebook\Markdown\Blocks\FencedCodeBlock as ASTNode;
use namespace Facebook\Markdown\Inlines;
use namespace HH\Lib\{C, Str, Vec};

final class FencedCodeBlock extends FencedBlock {
  const string PATTERN = '/^ {0,3}(?<fence>`{3,}|~{3,})(?<info>[^`]*)?$/';

  public function __construct(
    private string $content,
    private ?string $infoString,
  ) {
  }

  public function getContent(): string {
    return $this->content;
  }

  public function getInfoString(): ?string {
    return $this->infoString;
  }

  protected static function createFromLines(
    vec<string> $lines,
    bool $eof,
  ): this {
    $first = C\firstx($lines);
    $matches = [];
    invariant(
      \preg_match(self::PATTERN, $first, $matches) === 1,
      'Invalid first line',
    );
    $info = Str\trim($matches['info'] ?? '');
    if ($info === '') {
      $info = null;
    }

    $content = $lines
      |> Vec\slice($$, 1, C\count($lines) - ($eof ? 1 : 2))
      |> Str\join($$, "\n");
    return new self($content, $info);
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
    return new ASTNode($this->infoString, $this->content);
  }
}
