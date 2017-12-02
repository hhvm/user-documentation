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

namespace Facebook\GFM;

function parse(
  ParserContext $context,
  string $markdown,
): Blocks\Document {
  return UnparsedBlocks\Block::parse($context->getBlockContext(), $markdown)
    ->withParsedInlines($context->getInlineContext());
}
