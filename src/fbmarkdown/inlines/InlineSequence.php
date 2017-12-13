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

use namespace HH\Lib\{Str, Vec};

final class InlineSequence extends Inline {
  public function __construct(private vec<Inline> $children) {
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
    Context $_,
    string $_,
    int $_,
  ): ?(Inline, int) {
    return null;
  }
}
