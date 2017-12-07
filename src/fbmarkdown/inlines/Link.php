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

use function Facebook\Markdown\_Private\{
  consume_link_destination,
  consume_link_title,
};
use type Facebook\Markdown\UnparsedBlocks\LinkReferenceDefinition;
use namespace HH\Lib\{Str, Vec};

class Link extends Inline {
  public function __construct(
    private vec<Inline> $text,
    private string $destination,
    private ?string $title,
  ) {
  }

  public function getContentAsPlainText(): string {
    return $this->text
      |> Vec\map($$, $child ==> $child->getContentAsPlainText())
      |> Str\join($$, '');
  }

  public function getText(): vec<Inline> {
    return $this->text;
  }

  public function getDestination(): string {
    return $this->destination;
  }

  public function getTitle(): ?string {
    return $this->title;
  }

  public static function consume(
    Context $ctx,
    string $_last,
    string $string,
  ): ?(Link, string, string) {
    return self::consumeLinkish(
      $ctx,
      $string,
      keyset[
        CodeSpan::class,
        AutoLink::class,
        RawHTML::class,
      ],
    );
  }

  public static function consumeLinkish(
    Context $ctx,
    string $string,
    keyset<classname<Inline>> $inners,
  ): ?(Link, string, string) {
    if ($string[0] !== '[') {
      return null;
    }

    $depth = 1;

    $str = Str\slice($string, 1);
    $text = vec[];
    $part = '';
    $key = '';

    $last = '';
    $chr = '';

    while (!Str\is_empty($str)) {
      $orig_str = $str;
      $chr = $str[0];
      $str = Str\slice($str, 1);

      if ($chr === ']') {
        --$depth;
        if ($depth === 0) {
          break;
        }
        $part .= ']';
        $last = $chr;
        continue;
      }
      if ($chr === '[') {
        $part .= '[';
        ++$depth;
        $last = $chr;
        continue;
      }
      if ($chr === '\\') {
        if (!Str\is_empty($str)) {
          $next = $str[0];
          if ($next === '[' || $next === ']') {
            $part .= '\\'.$next;
            $str = Str\slice($str, 1);
            continue;
          }
        }
      }

      $result = null;
      foreach ($inners as $type) {
        $result = $type::consume($ctx, $last, $orig_str);
        if ($result !== null) {
          break;
        }
      }
      if ($result !== null) {
        if ($part !== '') {
          $text = Vec\concat($text, parse($ctx, $part));
          $key .= $part;
          $part = '';
        }
        list($next, $last, $str) = $result;
        $text[] = $next;
        continue;
      }
      $last = $chr;
      $part .= $chr;
    }

    if ($depth !== 0) {
      return null;
    }

    if ($part !== '') {
      $key .= $part;
      $text = Vec\concat($text, parse($ctx, $part));
    }

    if (Str\starts_with($str, '[]')) {
      // collapsed reference link
      $def = $ctx->getBlockContext()->getLinkReferenceDefinition($key);
      if ($def === null) {
        return null;
      }

      return tuple(
        new self($text, $def->getDestination(), $def->getTitle()),
        ']',
        Str\slice($str, 2),
      );
    }

    if (Str\starts_with($str, '[')) {
      // full reference link
      $depth = 1;
      $matched = '';
      $len = Str\length($str);
      for ($i = 1; $i < $len && $i <= 999; ++$i) {
        $char = $str[$i];
        if ($char === '[') {
          ++$depth;
          $matched .= $char;
          continue;
        }
        if ($char === ']') {
          --$depth;
          if ($depth === 0) {
            break;
          }
          $matched .= $char;
          continue;
        }
        if ($char === '\\') {
          if ($i + 1 >= $len) {
            return null;
          }
          $matched .= $char.$str[$i+1];
          ++$i;
          continue;
        }
        $matched .= $char;
      }
      if ($depth !== 0) {
        return null;
      }

      $key = LinkReferenceDefinition::normalizeKey($matched);
      $def = $ctx->getBlockContext()->getLinkReferenceDefinition($key);

      if ($def === null) {
        return null;
      }

      return tuple(
        new self($text, $def->getDestination(), $def->getTitle()),
        ']',
        Str\slice($str, 1, $len - 2),
      );
    }

    if (!Str\starts_with($str, '(')) {
      // shortcut reference link?
      $def = $ctx->getBlockContext()->getLinkReferenceDefinition($key);
      if ($def === null) {
        return null;
      }

      return tuple(
        new self($text, $def->getDestination(), $def->getTitle()),
        ']',
        $str,
      );
    }

    $str = Str\trim_left(Str\slice($str, 1));

    $destination = consume_link_destination($str);

    if ($destination === null) {
      return null;
    }

    list($destination, $idx) = $destination;
    $str = Str\trim_left(Str\slice($str, $idx));

    if ($str === '') {
      return null;
    }

    $title = consume_link_title($str);
    if ($title !== null) {
      list($title, $idx) = $title;
      $str = Str\trim_left(Str\slice($str, $idx));
    } else {
      // make title ?string, instead of string|?(string, string)
      $title = null;
    }

    if ($str === '') {
      return null;
    }

    if ($str[0] !== ')') {
      return null;
    }

    return tuple(
      new self($text, $destination, $title),
      ')',
      Str\slice($str, 1),
    );
  }
}
