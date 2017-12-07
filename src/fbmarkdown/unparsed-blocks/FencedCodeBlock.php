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
  const string PATTERN = '/^(?<indent> {0,3})(?<fence>`{3,}|~{3,})(?<info>[^`]*)?$/';

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
    int $column,
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
    $indent = Str\length($matches['indent']);

    $content = $lines
      |> Vec\slice($$, 1, C\count($lines) - ($eof ? 1 : 2))
      |> Vec\map($$, $line ==> self::unindentLine($line, $indent, $column))
      |> Str\join($$, "\n");
    return new self($content, $info);
  }

  private static function unindentLine(
    string $line,
    int $indent,
    int $column,
  ): string {
    if ($indent === 0) {
      return $line;
    }
    $stripped = Lines::stripWhitespacePrefix($line, $indent, $column);
    if ($stripped !== null) {
      return $stripped;
    }

    return Str\trim_left($line);
  }

  <<__Override>>
  protected static function getEndPatternForFirstLine(
    Context $_,
    string $first,
  ): ?string {
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
