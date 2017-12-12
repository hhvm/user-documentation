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

use type Facebook\Markdown\Blocks\ListOfItems as ASTNode;
use namespace Facebook\Markdown\Inlines;
use namespace Facebook\TypeAssert;
use namespace HH\Lib\{C, Str, Vec};

final class ListOfItems extends ContainerBlock<ListItem> {
  public function __construct(
    private bool $loose,
    vec<ListItem> $children,
  ) {
    parent::__construct($children);
  }

  private static function consumeItem(
    Context $context,
    Lines $lines,
  ): ?(ListItem, Lines) {
    if (ThematicBreak::consume($context, $lines) !== null) {
      return null;
    }

    foreach ($context->getListItemTypes() as $type) {
      $match = $type::consume($context, $lines);
      if ($match!== null) {
        return $match;
      }
    }
    return null;
  }

  public static function consume(
    Context $context,
    Lines $lines,
  ): ?(ListOfItems, Lines) {
    $first = self::consumeItem($context, $lines);
    if ($first === null) {
      return null;
    }

    list($first, $lines) = $first;
    $nodes = vec[$first];

    $loose = $first->makesListLoose();
    $d = $first->getDelimiter();

    if (
      $context->isInParagraphContinuation()
      && $first->isOrderedList()
      && $first->getNumber() !== 1
    ) {
      return null;
    }

    $pre_blank = null;

    while (!$lines->isEmpty()) {
      $next = self::consumeItem($context, $lines);
      if ($next === null) {
        list($line, $rest) = $lines->getFirstLineAndRest();
        if (Lines::isBlankLine($line)) {
          $pre_blank = tuple($loose, $nodes, $lines);
          $loose = true;
          $lines = $rest;
          continue;
        }
        break;
      }
      list($next, $rest) = $next;
      if ($next->getDelimiter() !== $d) {
        break;
      }
      $pre_blank = null;
      $nodes[] = $next;
      $loose = $loose || $next->makesListLoose();
      $lines = $rest;
    }

    if ($pre_blank !== null) {
      list($loose, $nodes, $lines) = $pre_blank;
    }

    return tuple(new self($loose, $nodes), $lines);
  }

  <<__Override>>
  public function withParsedInlines(Inlines\Context $ctx): ASTNode {
    return new ASTNode(
      $this->loose,
      Vec\map($this->children, $child ==> $child->withParsedInlines($ctx)),
    );
  }
}
