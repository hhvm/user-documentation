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

use namespace HH\Lib\{C, Str, Vec};
use type Facebook\Markdown\Blocks\Heading as ASTHeading;
use namespace Facebook\Markdown\Inlines;

class ATXHeading extends LeafBlock implements BlockProducer {
  const vec<string> PATTERNS = vec[
    '/^ {0,3}(?<level>#{1,6})([ \t](?<title>.*))?[ \t]+#+[ \t]*$/',
    '/^ {0,3}(?<level>#{1,6})([ \t](?<title>.*))?$/',
  ];

  public function __construct(private int $level, private string $heading) {
  }

  public static function consume(
    Context $_context,
    Lines $lines,
  ): ?(Block, Lines) {
    list($first, $rest) = $lines->getFirstLineAndRest();

    $matches = [];
    $title = null;
    foreach (self::PATTERNS as $pattern) {
      $result = \preg_match($pattern, $first, &$matches);
      if ($result === 1) {
        $title = $matches['title'] ?? '';
        break;
      }
    }

    if ($title === null) {
      return null;
    }

    $level = Str\length($matches['level']);
    return tuple(new self($level, Str\trim($title)), $rest);
  }

  <<__Override>>
  public function withParsedInlines(Inlines\Context $ctx): ASTHeading {
    return new ASTHeading(
      $this->level,
      Inlines\parse($ctx, $this->heading),
    );
  }
}
