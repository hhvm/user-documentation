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

use namespace Facebook\Markdown\{Blocks, Inlines};
use namespace HH\Lib\{C, Str, Vec};

class TaskListItemExtension extends ListItem {
  public function __construct(
    private bool $checked,
    int $indentation,
    string $delimiter,
    ?int $number,
    vec<Block> $children,
  ) {
    parent::__construct(
      $indentation,
      $delimiter,
      $number,
      $children,
    );
  }

  <<__Override>>
  protected static function createFromContents(
    Context $context,
    int $indentation,
    string $delimiter,
    ?int $number,
    Lines $contents,
  ): ListItem {
    if ($contents->isEmpty()) {
      return parent::createFromContents(
        $context,
        $indentation,
        $delimiter,
        $number,
        $contents,
      );
    }
    list($first, $rest) = $contents->getFirstLineAndRest();
    $first = Str\trim_left($first);
    if (Str\starts_with($first, '[ ] ')) {
      $contents = $contents->withoutFirstNBytes(4);
      return new self(
        /* checked = */ false,
        $indentation,
        $delimiter,
        $number,
        self::consumeChildren($context, $contents),
      );
    }

    if (Str\starts_with($first, '[x] ')) {
      $contents = $contents->withoutFirstNBytes(4);
      return new self(
        /* checked = */ true,
        $indentation,
        $delimiter,
        $number,
        self::consumeChildren($context, $contents),
      );
    }

    return parent::createFromContents(
      $context,
      $indentation,
      $delimiter,
      $number,
      $contents,
    );
  }

  <<__Override>>
  public function withParsedInlines(
    Inlines\Context $ctx,
  ): Blocks\TaskListItemExtension {
    return new Blocks\TaskListItemExtension(
      $this->checked,
      $this->number,
      Vec\map($this->children, $child ==> $child->withParsedInlines($ctx)),
    );
  }
}
