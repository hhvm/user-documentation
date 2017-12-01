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

namespace Facebook\GFM\Inlines;

use type Facebook\GFM\UnparsedBlocks\HTMLBlock;
use namespace HH\Lib\{C, Str};

final class RawHTML extends Inline {
  public function __construct(
    private string $content,
  ) {
  }

  public function getContent(): string {
    return $this->content;
  }

  public function getContentAsPlainText(): string {
    return '';
  }

  // From the GFM spec
  const string OPEN_TAG =
    '<'.HTMLBlock::TAG_NAME.
    '('.HTMLBlock::ATTRIBUTE.')*'.
    ' *'.
    ' \\/?>';
  const string CLOSING_TAG = '<\\/'.HTMLBlock::TAG_NAME.' *>';
  const string DECLARATION = '<![A-Z]+ +[^>]+>';

  public static function consume(
    Context $context,
    string $_last,
    string $string,
  ): ?(Inline, string, string) {
    $matches = [];
    if (
      \preg_match(
        '/^'.self::OPEN_TAG.'|'.self::CLOSING_TAG.'|'.self::DECLARATION.'/i',
        $string,
        $matches,
      ) === 1
    ) {
      $match = $matches[0];
      return tuple(
        new self($match),
        $match[Str\length($match) - 1],
        Str\strip_prefix($string, $match),
      );
    }

    return
      self::consumeHtmlComment($string)
      ?? self::consumeProcessingInstruction($string)
      ?? self::consumeCDataSection($string);
  }

  private static function consumeHtmlComment(
    string $in,
  ): ?(Inline, string, string) {
    if (!Str\starts_with($in, '<!--')) {
      return null;
    }

    $rest = Str\slice($in, 4);

    // We need `--`...
    $end = Str\search($rest, '--');
    if ($end === null) {
      return null;
    }

    // ...but only in the context of `-->`
    if (($rest[$end + 1] ?? null) !== '>') {
      return null;
    }

    $text = Str\slice($rest, 0, $end);
    if (C\any(vec['-', '->'], $bad ==> Str\starts_with($text, $bad))) {
      return null;
    }
    if (Str\ends_with($text, '-')) {
      return null;
    }

    $match = '<!--'.$text.'-->';
    return tuple(new self($match), '>', Str\strip_prefix($in, $match));
  }

  private static function consumeProcessingInstruction(
    string $in,
  ): ?(Inline, string, string) {
    return self::consumeFencedSection($in, '<?', '?>');
  }

  private static function consumeFencedSection(
    string $in,
    string $start,
    string $end,
  ): ?(Inline, string, string) {
    if (!Str\starts_with($in, $start)) {
      return null;
    }
    $idx = Str\search($in, $end);
    if ($idx === null) {
      return null;
    }

    $match = Str\slice($in, 0, $idx).$end;
    $last = $match[Str\length($match) - 1];
    return tuple(new self($match), $last, Str\strip_prefix($in, $match));
  }

  private static function consumeCDataSection(
    string $in,
  ): ?(Inline, string, string) {
    return self::consumeFencedSection($in, '<![CDATA[', ']]>');
  }
}
