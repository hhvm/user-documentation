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

<<__ConsistentConstruct>>
class RawHTML extends Inline {
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
    '\\s*'.
    '\\/?>';
  const string CLOSING_TAG = '<\\/'.HTMLBlock::TAG_NAME.'\\s*>';
  const string DECLARATION = '<![A-Z]+\\s+[^>]+>';

  <<__Override>>
  public static function consume(
    Context $context,
    string $string,
    int $offset,
  ): ?(Inline, int) {
    if (!$context->isHTMLEnabled()) {
      return null;
    }
    if ($string[$offset] !== '<') {
      return null;
    }

    $slice = Str\slice($string, $offset);

    $matches = [];
    if (
      \preg_match(
        '/^('.self::OPEN_TAG.'|'.self::CLOSING_TAG.'|'.self::DECLARATION.')/i',
        $slice,
        &$matches,
      ) === 1
    ) {
      $match = $matches[0];
      $offset += Str\length($match);
      return tuple(
        new self($match),
        $offset,
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
    $match = self::consumeFencedSection($in, $offset, '<!--', '-->');
    if ($match === null) {
      return null;
    }
    list($comment, $offset) = $match;
    $content = $comment->getContent();
    $text = Str\slice($content, 4, Str\length($content) - 7);

    if (Str\starts_with($text, '>')) {
      return null;
    }

    if (Str\starts_with($text, '->')) {
      return null;
    }

    if (Str\ends_with($text, '-')) {
      return null;
    }

    if (Str\contains($text, '--')) {
      return null;
    }

    return $match;
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
  ): ?(this, int) {
    $slice = Str\slice($in, $offset);
    if (!Str\starts_with($slice, $start)) {
      return null;
    }

    $idx = Str\search($in, $end, $offset + Str\length($start));
    if ($idx === null) {
      return null;
    }
    $idx += Str\length($end);

    $match = Str\slice($in, $offset, $idx - $offset);
    return tuple(new static($match), $idx);
  }

  private static function consumeCDataSection(
    string $in,
    int $offset,
  ): ?(Inline, int) {
    return self::consumeFencedSection($in, $offset, '<![CDATA[', ']]>');
  }
}
