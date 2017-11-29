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

namespace Facebook\GFM\Blocks;

use namespace HH\Lib\{C, Str};

abstract class Block {

  public abstract static function consume(
    Context $context,
    vec<string> $lines,
  ): ?(Block, vec<string>);

  protected static function isParagraphContinuationText(
    Context $context,
    vec<string> $lines,
  ): bool {
    return !C\any(
      $context->getBlockTypes(),
      (classname<Block> $block) ==> !C\contains_key(
        $context->getIgnoredBlockTypesForParagraphContinuation(),
        $block,
      ) &&
        $block::consume($context, $lines) !== null,
    );
  }

  final public static function parse(
    Context $context,
    string $markdown,
  ): Document {
    $lines = Str\split($markdown, "\n");
    list($document, $_) = Document::consume($context, $lines);
    return $document;
  }
}
