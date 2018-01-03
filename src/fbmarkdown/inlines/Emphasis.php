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

class Emphasis extends Inline {
  const string UNICODE_WHITESPACE = "[\\pZ\u{0009}\u{000d}\u{000a}\u{000c}]";
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
    return $this->content
      |> Vec\map($$, $child ==> $child->getContentAsPlainText())
      |> Str\join($$, '');
  }

  <<__Override>>
  public static function consume(
    Context $context,
    string $markdown,
    int $initial_offset,
  ): ?(Inline, int) {
    $offset = $initial_offset;
    if (!self::isStartOfRun($context, $markdown, $offset)) {
      return null;
    }
    $first = $markdown[$offset];
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

      if (self::isStartOfRun($context, $markdown, $offset)) {
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

      $text .= $markdown[$offset];
    }

    if ($text !== '') {
      $stack[] = new Stack\TextNode($text);
    }

    // Modified `process_emphasis` procedure from GFM spec appendix
    $position = 0;
    $openers_bottom = dict[
      '*' => vec[0, 0, 0],
      '_' => vec[0, 0, 0],
    ];

    while ($position < C\count($stack)) {
      // self::debugDump($markdown, $position, $stack);
      $closer_idx = self::findCloser($stack, $position);
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
      $closer_len = Str\length($closer->getText()) % 3;
      $bottom = $openers_bottom[$char][$closer_len];
      for ($i = $position - 1; $i >= $bottom; $i--) {
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

        // intra-word delimiters must match exactly
        // e.g.
        //  - `*foo**bar` is not emphasized
        //  - `**foo**bar` is emphasized
        if (
          (
            ($closer->getFlags() & self::IS_START)
            || ($item->getFlags() & self::IS_END)
          )
          && (
            (Str\length($closer->getText()) + Str\length($item->getText()))
            % 3 === 0
          )
        ) {
          continue;
        }
        $opener = $item;
        break;
      }
      $opener_idx = $i;

      if ($opener === null) {
        $openers_bottom[$char][$closer_len] = $position - 1;
        if (!($closer_flags & self::IS_START)) {
          $stack[$closer_idx] = new Stack\TextNode($closer_text);
        }
        ++$position;
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
          $opener->getStartOffset() + $chomp,
          $opener->getEndOffset(),
        );
      } else {
        $position--;
      }

      $first_content_idx = $opener_idx + 1;
      $last_content_idx = $closer_idx - 1;
      $content_length = ($last_content_idx - $first_content_idx) + 1;

      $mid_nodes[] =
        Vec\slice($stack, $first_content_idx, $content_length)
        |> self::consumeStackSlice($context, $$)
        |> new self($strong, $$)
        |> new Stack\EmphasisNode(
          $$,
          $opener->getEndOffset() - $chomp,
          $closer->getStartOffset() + $chomp,
        );
      $position -= $content_length;

      if ($closer_text !== '') {
        $mid_nodes[] = new Stack\DelimiterNode(
          $closer_text,
          $closer->getFlags(),
          $closer->getStartOffset() + $chomp,
          $closer->getEndOffset(),
        );
      }

      $stack = Vec\concat(
        Vec\take($stack, $opener_idx),
        $mid_nodes,
        Vec\drop($stack, $closer_idx + 1),
      );
    }


    $first = C\first($stack);
    if ($first instanceof Stack\EmphasisNode) {
      return tuple(
        $first->getContent(),
        $first->getEndOffset(),
      );
    }

    $first = C\find(
      $stack,
      $elem ==> $elem instanceof Stack\EmphasisNode,
    );

    if ($first === null) {
      return null;
    }
    assert($first instanceof Stack\EmphasisNode);

    $children = Vec\concat(
      parse(
        $context,
        Str\slice(
          $markdown,
          $initial_offset,
          $first->getStartOffset() - $initial_offset,
        ),
      ),
      vec[$first->getContent()],
    );

    return tuple(
      new InlineSequence($children),
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

  private static function startsWithWhitespace(
    string $markdown,
    int $offset,
  ): bool {
    if ($offset === Str\length($markdown)) {
      return true;
    }
    return \preg_match(
      '/^'.self::UNICODE_WHITESPACE.'/u',
      Str\slice($markdown, $offset),
    ) === 1;
  }

  private static function endsWithWhitespace(
    string $markdown,
    int $offset,
  ): bool {
    if ($offset === 0) {
      return true;
    }
    return \preg_match(
      '/'.self::UNICODE_WHITESPACE.'$/u',
      Str\slice($markdown, 0, $offset),
    ) === 1;
  }

  private static function isLeftFlankingDelimiterRun(
    string $markdown,
    int $start_offset,
    int $end_offset,
  ): bool {
    $len = Str\length($markdown);
    $next = $end_offset === $len ? '' : $markdown[$end_offset];
    $previous = $start_offset === 0 ? '' : $markdown[$start_offset - 1];

    if (self::startsWithWhitespace($markdown, $end_offset)) {
      return false;
    }

    $previous_punctuation = C\contains_key(self::PUNCTUATION, $previous);
    $previous_whitespace = self::endsWithWhitespace($markdown, $start_offset);

    if ($previous_whitespace || $previous_punctuation) {
      return true;
    }

    // No intra-word `_` emphasis, but `*` is fine
    $next_punctuation = C\contains_key(self::PUNCTUATION, $next);
    if ((!$next_punctuation) && $markdown[$start_offset] !== '_') {
      return true;
    }

    return false;
  }

  private static function isRightFlankingDelimiterRun(
    string $markdown,
    int $start_offset,
    int $end_offset,
  ): bool {
    $len = Str\length($markdown);
    $next = $end_offset === $len ? '' : $markdown[$end_offset];
    $previous = $start_offset === 0 ? '' : $markdown[$start_offset - 1];

    if (self::endsWithWhitespace($markdown, $start_offset)) {
      return false;
    }

    $next_whitespace = self::startsWithWhitespace($markdown, $end_offset);
    $next_punctuation = C\contains_key(self::PUNCTUATION, $next);

    if ($next_whitespace || $next_punctuation) {
      return true;
    }

    // No intra-word `_` emphasis, but `*` is fine
    $previous_punctuation = C\contains_key(self::PUNCTUATION, $previous);
    if ((!$previous_punctuation) && $markdown[$start_offset] !== '_') {
      return true;
    }

    return false;
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

  private static function debugDump(
    string $markdown,
    int $position,
    vec<Stack\Node> $stack,
  ): void {
    printf("-------------------- %d\n", $position);
    print(
      Vec\map_with_key(
        $stack,
        ($idx, $item) ==> '  '.$idx.'. '.$item->debugDump($markdown)
      )
      |> Str\join($$, "\n")
      |> $$."\n"
    );
  }

  private static function isStartOfRun(
    Context $context,
    string $markdown,
    int $offset,
  ): bool {
    $first = $markdown[$offset];
    if ($first !== '*' && $first !== '_') {
      return false;
    }

    if ($offset === 0) {
      return true;
    }

    $previous = $markdown[$offset - 1];
    if ($previous !== "\\" && $previous !== $first) {
      return true;
    }

    $previous = parse(
      $context,
      Str\slice($markdown, 0, $offset),
    );

    return C\last($previous) instanceof BackslashEscape;
  }
}
