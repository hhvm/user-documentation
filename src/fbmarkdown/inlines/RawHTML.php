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

namespace Facebook\Markdown\Inlines;

use type Facebook\Markdown\UnparsedBlocks\HTMLBlock;
use namespace HH\Lib\{C, Str};

final class RawHTML extends Inline {
  public function __construct(
    private string $content,
  ) {
  }

  public function getContent(): string {
    return $this->content;
  }

  <<__Override>>
  public function getContentAsPlainText(): string {
    return '';
  }

  // From the GFM spec
  const string OPEN_TAG =
    '<'.HTMLBlock::TAG_NAME.
    '('.HTMLBlock::ATTRIBUTE.')*'.
    ' *'.
    '\\/?>';
  const string CLOSING_TAG = '<\\/'.HTMLBlock::TAG_NAME.' *>';
  const string DECLARATION = '<![A-Z]+ +[^>]+>';

  <<__Override>>
  public static function consume(
    Context $context,
    string $string,
    int $offset,
  ): ?(Inline, int) {
    if (!$context->isHTMLEnabled()) {
      return null;
    }

    $matches = [];
    if (
      \preg_match(
        '/^('.self::OPEN_TAG.'|'.self::CLOSING_TAG.'|'.self::DECLARATION.')/i',
        Str\slice($string, $offset),
        $matches,
      ) === 1
    ) {
      $match = $matches[0];
      return tuple(
        new self($match),
        $offset + Str\length($match),
      );
    }

    return
      self::consumeHtmlComment($string, $offset)
      ?? self::consumeProcessingInstruction($string, $offset)
      ?? self::consumeCDataSection($string, $offset);
  }

  private static function consumeHtmlComment(
    string $in,
    int $offset,
  ): ?(Inline, int) {
    if (Str\slice($in, $offset, 3) !== '<!--') {
      return null;
    }

    $offset += 4;

    // We need `-->`...
    $end = Str\search($in, '-->', $offset);
    if ($end === null) {
      return null;
    }

    // ...but without `--` first
    $dash_dash = Str\search($in, '--', $offset);
    assert($dash_dash !== null); // we already found an end marker
    if ($dash_dash < $end) {
      return null;
    }

    $text = Str\slice($in, $offset, $end - $offset);
    if (C\any(vec['-', '->'], $bad ==> Str\starts_with($text, $bad))) {
      return null;
    }
    if (Str\ends_with($text, '-')) {
      return null;
    }

    $match = '<!--'.$text.'-->';
    return tuple(new self($match), $end + 3);
  }

  private static function consumeProcessingInstruction(
    string $in,
    int $offset,
  ): ?(Inline, int) {
    return self::consumeFencedSection($in, $offset, '<?', '?>');
  }

  private static function consumeFencedSection(
    string $in,
    int $offset,
    string $start,
    string $end,
  ): ?(Inline, int) {
    $slice = Str\slice($in, $offset);
    if (!Str\starts_with($slice, $start)) {
      return null;
    }
    $idx = Str\search($in, $end, $offset);
    if ($idx === null) {
      return null;
    }

    $match = Str\slice($in, $offset, $idx).$end;
    return tuple(new self($match), $idx + Str\length($end));
  }

  private static function consumeCDataSection(
    string $in,
    int $offset,
  ): ?(Inline, int) {
    return self::consumeFencedSection($in, $offset, '<![CDATA[', ']]>');
  }
}
