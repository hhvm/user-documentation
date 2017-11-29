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

use namespace HH\Lib\{C, Keyset, Str};

abstract class Inline {
  abstract public static function consume(
    Context $context,
    string $chars,
  ): ?(Inline, string);

  final public static function parse(
    Context $context,
    string $markdown,
  ): vec<Inline> {
    return self::parseWithBlacklist(
      $context,
      $markdown,
      keyset[],
    );
  }

  final protected static function parseWithBlacklist(
    Context $context,
    string $markdown,
    keyset<classname<Inline>> $blacklist,
  ): vec<Inline> {
    $types = $context->getInlineTypes();
    foreach ($blacklist as $type) {
      unset($types[$type]);
    }

    $out = vec[];

    while (!Str\is_empty($markdown)) {
      $result = null;
      foreach ($types as $type) {
        $result = $type::consume($context, $markdown);
        if ($result !== null) {
          break;
        }
      }
      invariant($result !== null, 'TextualContent should consume everything');
      list($inline, $markdown) = $result;
      $out[] = $inline;
    }
    return $out;
  }
}
