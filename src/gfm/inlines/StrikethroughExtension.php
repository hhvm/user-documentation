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

use namespace HH\Lib\{Str, Vec};

final class StrikethroughExtension extends Inline {
  public function __construct(
    private vec<Inline> $children,
  ) {
  }

  public function getChildren(): vec<Inline> {
    return $this->children;
  }

  public function getContentAsPlainText(): string {
    return $this->children
      |> Vec\map($$, $child ==> $child->getContentAsPlainText())
      |> Str\join($$, '');
  }

  public static function consume(
    Context $context,
    string $string,
  ): ?(Inline, string) {
    if ($string[0] !== '~') {
      return null;
    }

    $string = Str\trim_left($string, '~');
    $end_pos = Str\search($string, '~');
    if ($end_pos === null) {
      return null;
    }

    $para_pos = Str\search($string, "\n\n");
    if ($para_pos !== null && $para_pos < $end_pos) {
      return null;
    }

    $matched = Str\slice($string, 0, $end_pos);
    $children = Inline::parse($context, $matched);
    $rest = Str\trim_left(Str\slice($string, $end_pos + 1), '~');
    return tuple(new self($children), $rest);
  }
}
