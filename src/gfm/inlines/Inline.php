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

use type Facebook\GFM\ASTNode as ASTNode;
use namespace HH\Lib\{C, Keyset, Str};

abstract class Inline extends ASTNode {
  abstract public static function consume(
    Context $context,
    string $previous,
    string $chars,
  ): ?(Inline, string, string);

  abstract public function getContentAsPlainText(): string;
}
