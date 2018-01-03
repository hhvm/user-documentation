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

use namespace Facebook\Markdown\Inlines\_Private\StrPos;
use namespace HH\Lib\{Str, Vec};

class StrikethroughExtension extends Inline {
  public function __construct(
    private vec<Inline> $children,
  ) {
  }

  public function getChildren(): vec<Inline> {
    return $this->children;
  }

  <<__Override>>
  public function getContentAsPlainText(): string {
    return $this->children
      |> Vec\map($$, $child ==> $child->getContentAsPlainText())
      |> Str\join($$, '');
  }

  <<__Override>>
  public static function consume(
    Context $context,
    string $string,
    int $offset,
  ): ?(Inline, int) {
    if ($string[$offset] !== '~') {
      return null;
    }

    $start_pos = StrPos\trim_left($string, $offset, '~');
    $end_pos = Str\search($string, '~', $start_pos);
    if ($end_pos === null) {
      return null;
    }

    $para_pos = Str\search($string, "\n\n", $start_pos);
    if ($para_pos !== null && $para_pos < $end_pos) {
      return null;
    }

    $matched = Str\slice($string, $start_pos, $end_pos - $start_pos);
    $children = parse($context, $matched);

    $end_pos = StrPos\trim_left($string, $end_pos, '~');
    return tuple(new self($children), $end_pos);
  }
}
