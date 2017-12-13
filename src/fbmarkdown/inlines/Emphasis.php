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

use namespace Facebook\Markdown\Inlines\_Private\EmphasisStack as Stack;
use namespace HH\Lib\{C, Str, Vec};

final class Emphasis extends Inline {
  const keyset<string> WHITESPACE = keyset[
    " ", "\t", "\x0a", "\x0b", "\x0C", "\x0d",
  ];
  const keyset<string> PUNCTUATION = keyset[
    '!', '"', '#', '$', '%', '&', "'", '(', ')', '*', '+', ',', '-', '.',
    '/', ':', ';', '<', '=', '>', '?', '@', '[', '\\', ']', '^', '_', '`',
    '{', '|', '}', '~',
  ];

  const int IS_START = 1 << 0;
  const int IS_END = 1 << 1;

  public function __construct(
    private bool $isStrong,
    private vec<Inline> $content,
  ) {
  }

  public function isStrong(): bool {
    return $this->isStrong;
  }

  public function getContent(): vec<Inline> {
    return $this->content;
  }

  <<__Override>>
  public function getContentAsPlainText(): string {
    return '';
  }

  <<__Override>>
  public static function consume(
    Context $context,
    string $markdown,
    int $offset,
  ): ?(Inline, int) {
    $first = $markdown[$offset];
    if ($first !== '*' && $first !== '_') {
      return null;
    }
    // This is tricky as until we find the closing marker, we don't know if
    // `***` means:
    //  - `<strong><em>`
    //  - `<em><strong>`
    //  - `<em>**`
    //  - `<strong>*`
    //  - `***`

    $start = self::consumeDelimiterRun($markdown, $offset);
    list($start, $end_offset) = $start;
    if (!self::isLeftFlankingDelimiterRun($markdown, $offset, $end_offset)) {
      return null;
    }
    $stack = vec[
      new Stack\DelimiterNode(
        $start,
        self::IS_START,
        $offset,
        $end_offset,
      ),
    ];
    $offset = $end_offset;

    $text = '';

    $len = Str\length($markdown);
    for (; $offset < $len; ++$offset) {
      $inline = self::consumeHigherPrecedence($context, $markdown, $offset);
      if ($inline !== null) {
        if ($text !== '') {
          $stack[] = new Stack\TextNode($text);
          $text = '';
        }
        list($inline, $offset) = $inline;
        $offset--;
        $stack[] = new Stack\InlineNode($inline);
        continue;
      }

      $char = $markdown[$offset];
      if ($char === '*' || $char === '_') {
        list($run, $end_offset) = self::consumeDelimiterRun($markdown, $offset);
        $flags = 0;

        if (self::isLeftFlankingDelimiterRun($markdown, $offset, $end_offset)) {
          $flags |= self::IS_START;
        }
        if (
          self::isRightFlankingDelimiterRun($markdown, $offset, $end_offset)
        ) {
          $flags |= self::IS_END;
        }
        if ($flags !== 0) {
          if ($text !== '') {
            $stack[] = new Stack\TextNode($text);
            $text = '';
          }
          $stack[] =
            new Stack\DelimiterNode($run, $flags, $offset, $end_offset);
          $offset = $end_offset - 1;
          continue;
        }
      }

      $text .= $char;
    }

    if ($text !== '') {
      $stack[] = new Stack\TextNode($text);
    }

    // Modified `process_emphasis` procedure from GFM spec appendix;
    // stack is vec<delimiter|string|Inline>
    // delimiter is tuple(marker, flags);
    $position = 0;
    $openers_bottom = dict[
      '*' => -1,
      '_' => -1,
    ];

    while ($position + 1 < C\count($stack)) {
      $closer_idx = self::findCloser($stack, $position + 1);
      if ($closer_idx === null) {
        break;
      }
      $position = $closer_idx;
      $closer = $stack[$closer_idx];
      invariant(
        $closer instanceof Stack\DelimiterNode,
        'closer must be a delimiter',
      );
      list($closer_text, $closer_flags) = tuple(
        $closer->getText(),
        $closer->getFlags(),
      );
      $char = $closer_text[0];
      $opener = null;
      for ($i = $position - 1; $i > $openers_bottom[$char]; --$i) {
        $item = $stack[$i];
        if (!$item instanceof Stack\DelimiterNode) {
          continue;
        }
        if (!($item->getFlags() & self::IS_START)) {
          continue;
        }
        if ($item->getText()[0] !== $char) {
          continue;
        }
        $opener = $item;
        break;
      }
      $opener_idx = $i;

      if ($opener === null) {
        $openers_bottom[$char] = $position - 1;
        if (!($closer_flags & self::IS_START)) {
          $stack[$closer_idx] = new Stack\TextNode($closer_text);
          ++$position;
        }
        continue;
      }

      $opener_text = $opener->getText();
      $strong = Str\length($opener_text) >= 2 && Str\length($closer_text) >= 2;

      $chomp = $strong ? 2 : 1;
      $opener_text = Str\slice($opener_text, $chomp);
      $closer_text = Str\slice($closer_text, $chomp);

      $mid_nodes = vec[];

      if ($opener_text !== '') {
        $mid_nodes[] = new Stack\DelimiterNode(
          $opener_text,
          $opener->getFlags(),
          $opener->getStartOffset(),
          $opener->getEndOffset(),
        );
      } else {
        $position--;
      }

      $mid_nodes[] =
        Vec\slice($stack, $opener_idx + 1, $closer_idx - ($opener_idx + 1))
        |> self::consumeStackSlice($context, $$)
        |> new self($strong, $$)
        |> new Stack\EmphasisNode(
          $$,
          $opener->getStartOffset(),
          $closer->getEndOffset(),
        );
      if ($closer_text !== '') {
        $mid_nodes[] = new Stack\DelimiterNode(
          $closer_text,
          $closer->getFlags(),
          $closer->getStartOffset(),
          $closer->getEndOffset() - $chomp,
        );
      } else {
        $position--;
      }

      $stack = Vec\concat(
        Vec\take($stack, $opener_idx),
        $mid_nodes,
        Vec\drop($stack, $closer_idx + 1),
      );
    }

    $first = C\first($stack);
    if (!$first instanceof Stack\EmphasisNode) {
      return null;
    }

    return tuple(
      $first->getContent(),
      $first->getEndOffset(),
    );
  }

  private static function consumeStackSlice(
    Context $ctx,
    vec<Stack\Node> $nodes,
  ): vec<Inline> {
    return $nodes
      |> Vec\map($$, $node ==> $node->toInlines($ctx))
      |> Vec\flatten($$);
  }

  private static function findCloser(
    vec<Stack\Node> $in,
    int $position,
  ): ?int {
    $in = Vec\drop($in, $position);
    $offset = C\find_key(
      $in,
      $item ==>
        $item instanceof Stack\DelimiterNode
        && $item->getFlags() & self::IS_END,
    );
    if ($offset === null) {
      return null;
    }
    $idx = $position + $offset;
    return $idx;
  }

  private static function consumeDelimiterRun(
    string $markdown,
    int $offset,
  ): (string, int) {
    $slice = Str\slice($markdown, $offset);
    $matches = [];
    \preg_match('/^(\\*+|_+)/', $slice, $matches);
    $match = $matches[0];
    return tuple($match, $offset + Str\length($match));
  }

  private static function isLeftFlankingDelimiterRun(
    string $markdown,
    int $start_offset,
    int $end_offset,
  ): bool {
    $len = Str\length($markdown);
    $next = $end_offset === $len ? '' : $markdown[$end_offset];
    $previous = $start_offset === 0 ? '' : $markdown[$start_offset - 1];

    if (C\contains_key(self::WHITESPACE, $next)) {
      return false;
    }
    if (
      C\contains_key(self::PUNCTUATION, $next)
      && $previous !== ''
      && !C\contains_key(self::WHITESPACE, $previous)
      && !C\contains_key(self::PUNCTUATION, $previous)
    ) {
      return false;
    }
    return true;
  }

  private static function isRightFlankingDelimiterRun(
    string $markdown,
    int $start_offset,
    int $end_offset,
  ): bool {
    $len = Str\length($markdown);
    $next = $end_offset === $len ? '' : $markdown[$end_offset];
    $previous = $start_offset === 0 ? '' : $markdown[$start_offset - 1];

    if (C\contains_key(self::WHITESPACE, $previous)) {
      return false;
    }
    if (
      C\contains_key(self::PUNCTUATION, $previous)
      && $next !== ''
      && !C\contains_key(self::WHITESPACE, $next)
      && !C\contains_key(self::PUNCTUATION, $next)
    ) {
      return false;
    }
    return true;
  }

  private static function consumeHigherPrecedence(
    Context $context,
    string $markdown,
    int $offset,
  ): ?(Inline, int) {
    foreach ($context->getInlineTypes() as $type) {
      if ($type === self::class) {
        return null;
      }

      $result = $type::consume($context, $markdown, $offset);
      if ($result !== null) {
        return $result;
      }
    }

    invariant_violation('should be unreachable');
  }
}
