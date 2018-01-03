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

use type Facebook\Markdown\Blocks\TableExtension as ASTTableExtension;
use type Facebook\Markdown\Blocks\TableExtensionColumnAlignment as ColumnAlignment;
use namespace Facebook\Markdown\Inlines;
use namespace HH\Lib\{C, Str, Vec};

class TableExtension extends LeafBlock implements BlockProducer {
  public function __construct(
    private vec<string> $header,
    private vec<?ColumnAlignment> $alignments,
    private vec<vec<string>> $data,
  ) {
  }

  public static function consume(
    Context $ctx,
    Lines $lines,
  ): ?(Block, Lines) {
    if ($ctx->isInParagraphContinuation()) {
      return null;
    }

    $rows = vec[];
    while (!$lines->isEmpty()) {
      $result = self::consumeRow($ctx, $lines);
      if ($result === null) {
        break;
      }
      list($definitely_row, $row, $lines) = $result;
      if (C\count($rows) < 2 && !$definitely_row) {
        return null;
      }
      $rows[] = $row;
    }

    if (C\count($rows) < 2) {
      return null;
    }
    $header = $rows[0];
    $delimiter = $rows[1];

    $column_count = C\count($header);
    if (C\count($delimiter) !== $column_count) {
      /* Valid:
       *
       *   foo|bar
       *   ---|---
       *
       * Invalid:
       *
       *   foo|bar
       *   ---|---|---
       *
       *   foo|bar|baz
       *   ---|---
       */
      return null;
    }

    $alignments = vec[];
    foreach ($delimiter as $col) {
      $left = Str\starts_with($col, ':');
      $right = Str\ends_with($col, ':');
      $col = Str\trim($col, ':');
      if (Str\length($col) === 0) {
        return null;
      }
      $col = Str\trim($col, '-');
      if (Str\length($col) !== 0) {
        return null;
      }

      $align = null;
      if ($left && $right) {
        $align = ColumnAlignment::CENTER;
      } else if ($left) {
        $align = ColumnAlignment::LEFT;
      } else if ($right) {
        $align = ColumnAlignment::RIGHT;
      }
      $alignments[] = $align;
    }

    $data = vec[];
    foreach (Vec\drop($rows, 2) as $row) {
      $count = C\count($row);
      if ($count === $column_count) {
        $data[] = $row;
        continue;
      }
      if ($count > $column_count) {
        $data[] = Vec\take($row, $column_count);
        continue;
      }
      assert($count < $column_count);
      $data[] = Vec\concat(
        $row,
        Vec\fill($column_count - $count, ''),
      );
    }

    return tuple(
      new self(
        $header,
        $alignments,
        $data,
      ),
      $lines,
    );
  }

  private static function consumeRow(
    Context $context,
    Lines $lines,
  ): ?(bool, vec<string>, Lines) {
    list($first, $rest) = $lines->getFirstLineAndRest();

    $definitely_row = false;

    if (Str\starts_with($first, '|')) {
      $definitely_row = true;
      $first = Str\slice($first, 1);
    }
    if (Str\ends_with($first, '|')) {
      $definitely_row = true;
      $first = Str\slice($first, 0, Str\length($first) - 1);
    }

    $parts = vec[];
    $start = 0;
    $len = Str\length($first);
    while ($start !== null && $start < $len) {
      $end = Str\search($first, '|', $start);
      if ($end === null) {
        $parts[] = Str\slice($first, $start);
        break;
      }
      if ($end >> 1 && $first[$end - 1] === '\\') {
        $end = Str\search($first, '|', $end + 1);
      }

      if ($end === null) {
        $parts[] = Str\slice($first, $start);
        break;
      }

      $parts[] = Str\slice($first, $start, $end - $start);
      $start = $end + 1;
    }

    $definitely_row = $definitely_row || C\count($parts) >= 2;

    if (!$definitely_row) {
      $is_continuation = _Private\is_paragraph_continuation_text(
        $context,
        $lines,
      );
      if (!$is_continuation) {
        return null;
      }
    }

    return tuple(
      $definitely_row,
      Vec\map(
        $parts,
        $part ==> Str\trim($part) |> Str\replace($$, "\\|", '|'),
      ),
      $rest,
    );
  }

  <<__Override>>
  public function withParsedInlines(Inlines\Context $context): ASTTableExtension {
    return new ASTTableExtension(
      Vec\map($this->header, $cell ==> Inlines\parse($context, $cell)),
      $this->alignments,
      Vec\map(
        $this->data,
        $row ==> Vec\map($row, $cell ==> Inlines\parse($context, $cell)),
      ),
    );
  }
}
