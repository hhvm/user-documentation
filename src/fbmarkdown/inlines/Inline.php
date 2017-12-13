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

use type Facebook\Markdown\ASTNode as ASTNode;
use namespace HH\Lib\{C, Keyset, Str};

abstract class Inline extends ASTNode {
  abstract public static function consume(
    Context $context,
    string $chars,
    int $offset,
  ): ?(Inline, int);

  abstract public function getContentAsPlainText(): string;
}
