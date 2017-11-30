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

abstract class Inline implements ASTNode {
  abstract public static function consume(
    Context $context,
    string $previous,
    string $chars,
  ): ?(Inline, string, string);

  abstract public function getContentAsPlainText(): string;

  final public static function parse(
    Context $context,
    string $markdown,
  ): vec<Inline> {
    list($parsed, $_last, $rest) = self::parseWithBlacklist(
      $context,
      '',
      $markdown,
      keyset[],
    );
    invariant($rest === '', "TextualContent should have taken everything");
    return $parsed;
  }

  final protected static function parseWithBlacklist(
    Context $context,
    string $last,
    string $markdown,
    keyset<classname<Inline>> $blacklist,
  ): (vec<Inline>, string, string) {
    $types = $context->getInlineTypes();
    foreach ($blacklist as $type) {
      unset($types[$type]);
    }

    $out = vec[];

    while (!Str\is_empty($markdown)) {
      $result = null;
      foreach ($types as $type) {
        $result = $type::consume($context, $last, $markdown);
        if ($result !== null) {
          break;
        }
      }
      if ($result === null) {
        return tuple($out, $last, $markdown);
      }
      list($inline, $last, $markdown) = $result;
      $out[] = $inline;
    }
    return tuple($out, $last, '');
  }
}
