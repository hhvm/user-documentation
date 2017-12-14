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
use namespace Facebook\Markdown\Inlines\_Private\StrPos;
use type Facebook\Markdown\UnparsedBlocks\LinkReferenceDefinition;
use namespace HH\Lib\{Str, Vec};

class Link extends Inline {
  public function __construct(
    private vec<Inline> $text,
    private string $destination,
    private ?string $title,
  ) {
  }

  <<__Override>>
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

  <<__Override>>
  public static function consume(
    Context $ctx,
    string $string,
    int $offset,
  ): ?(Link, int) {
    return self::consumeLinkish(
      $ctx,
      $string,
      $offset,
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
    int $offset,
    keyset<classname<Inline>> $inners,
  ): ?(Link, int) {
    if ($string[$offset] !== '[') {
      return null;
    }

    $offset++;
    $depth = 1;

    $len = Str\length($string);
    $text = vec[];
    $part = '';
    $key = '';

    for ($offset = $offset; $offset < $len; ++$offset) {
      $chr = $string[$offset];

      if ($chr === ']') {
        --$depth;
        if ($depth === 0) {
          $offset++;
          break;
        }
        $part .= ']';
        continue;
      }
      if ($chr === '[') {
        $part .= '[';
        ++$depth;
        continue;
      }
      if ($chr === '\\') {
        if ($offset + 1 < $len) {
          $next = $string[$offset + 1];
          if ($next === '[' || $next === ']') {
            $part .= '\\'.$next;
            ++$offset;
            continue;
          }
        }
      }

      $result = null;
      foreach ($inners as $type) {
        $result = $type::consume($ctx, $string, $offset);
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
        list($next, $offset) = $result;
        $text[] = $next;
        continue;
      }
      $part .= $chr;
    }

    if ($depth !== 0) {
      return null;
    }

    if ($part !== '') {
      $key .= $part;
      $text = Vec\concat($text, parse($ctx, $part));
    }

    if (Str\slice($string, $offset, 2) === '[]') {
      // collapsed reference link
      $def = $ctx->getBlockContext()->getLinkReferenceDefinition($key);
      if ($def === null) {
        return null;
      }

      return tuple(
        new self($text, $def->getDestination(), $def->getTitle()),
        $offset + 2,
      );
    }

    if ($offset < $len && $string[$offset] === '[') {
      // full reference link
      $depth = 1;
      $matched = '';
      $offset++;
      for ($i = 0; $i < 999 && $offset < $len; ++$i, ++$offset) {
        $char = $string[$offset];
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
          if ($offset + 1 >= $len) {
            return null;
          }
          $matched .= $char.$string[$offset+1];
          ++$offset;
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
        $offset,
      );
    }

    if ($offset === $len || $string[$offset] !== '(') {
      // shortcut reference link?
      $def = $ctx->getBlockContext()->getLinkReferenceDefinition($key);
      if ($def === null) {
        return null;
      }

      return tuple(
        new self($text, $def->getDestination(), $def->getTitle()),
        $offset,
      );
    }
    $offset++;

    $slice = Str\slice($string, $offset);
    $destination = consume_link_destination($slice);

    if ($destination !== null) {
      list($destination, $consumed) = $destination;
    } else {
      $destination = '';
      $consumed = 0;
    }

    $offset = StrPos\trim_left($string, $offset + $consumed);

    if ($offset === $len) {
      return null;
    }

    $slice = Str\slice($string, $offset);
    $title = consume_link_title($slice);
    if ($title !== null) {
      list($title, $consumed) = $title;
      $offset = StrPos\trim_left($string, $offset + $consumed);
    } else {
      // make title ?string, instead of string|?(string, string)
      $title = null;
    }

    if ($offset === $len) {
      return null;
    }

    if ($string[$offset] !== ')') {
      return null;
    }

    return tuple(
      new self($text, $destination, $title),
      $offset + 1,
    );
  }
}
