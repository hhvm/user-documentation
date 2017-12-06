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

namespace Facebook\Markdown\UnparsedBlocks;

use namespace HH\Lib\C;


abstract class ContainerBlock extends Block {
  protected static function consumeChildren(
    Context $context,
    Lines $lines,
  ): vec<Block> {
    $children = vec[];
    while (!$lines->isEmpty()) {
      $match = null;
      foreach ($context->getBlockTypes() as $block) {
        $match = $block::consume($context, $lines);
        if ($match !== null) {
          break;
        }
      }
      invariant($match !== null, 'should *always* find a match');
      list($child, $new_lines) = $match;
      $children[] = $child;
      invariant(
        $lines->getCount() > $new_lines->getCount(),
        'consuming failed to reduce line count with class "%s" on line "%s"',
        get_class($child),
        $lines->getFirstLine(),
      );
      $lines = $new_lines;
    }
    return $children;
  }
}
