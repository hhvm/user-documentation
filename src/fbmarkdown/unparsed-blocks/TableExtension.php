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

final class TableExtension extends LeafBlock {
  public function __construct(
    private vec<string> $header,
    private vec<?ColumnAlignment> $alignments,
    private vec<vec<string>> $data,
  ) {
  }

  public static function consume(
    Context $ctx,
    vec<string> $lines,
  ): ?(Block, vec<string>) {
    $rows = vec[];
    while (!C\is_empty($lines)) {
      $result = self::consumeRow($ctx, $lines);
      if ($result === null) {
        break;
      }
      list($row, $lines) = $result;
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
    Context $_,
    vec<string> $lines,
  ): ?(vec<string>, vec<string>) {
    $first = C\firstx($lines);

    if (Str\starts_with($first, '|')) {
      $first = Str\slice($first, 1);
    }
    if (Str\ends_with($first, '|')) {
      $first = Str\slice($first, Str\length($first) - 1);
    }

    $part = '';
    $parts = vec[];
    $len = Str\length($first);
    for ($i = 0; $i < $len; ++$i) {
      $char = $first[$i];
      if ($char === '|') {
        $parts[] = (string) $part;
        $part = '';
        continue;
      }

      if ($char === "\\") {
        $next = ($i + 1 >= $len) ? null : $first[$i + 1];
        if ($next === '|') {
          $part .= $next;
          $i++;
          continue;
        }
      }
      $part .= $char;
    }

    if (C\is_empty($parts)) {
      return null;
    }
    if ($part !== '') {
      $parts[] = $part;
    }

    return tuple(
      Vec\map($parts, $part ==> Str\trim($part)),
      Vec\drop($lines, 1),
    );
  }

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
