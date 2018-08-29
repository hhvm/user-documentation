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

namespace HHVM\UserDocumentation\MarkdownExt;

use namespace Facebook\Markdown;
use namespace HH\Lib\{Str, Vec};

final class HTMLRenderer extends Markdown\HTMLRenderer {
  <<__Override>>
  protected function renderTableExtension(
    Markdown\Blocks\TableExtension $table,
  ): string {
    return
      '<div class="tableWrapper">'.
      parent::renderTableExtension($table).
      '</div>';
  }

  <<__Override>>
  protected function renderTableDataCell(
    Markdown\Blocks\TableExtension $table,
    int $_row_idx,
    int $col_idx,
    Markdown\Blocks\TableExtension::TCell $cell,
  ): string {
    $align = $table->getColumnAlignments()[$col_idx];
    if ($align !== null) {
      $align = ' align="'.$align.'"';
    }
    $heading = $table->getHeader()[$col_idx]
      |> Vec\map($$, $part ==> $part->getContentAsPlainText())
      |> Str\join($$, '');
    return
      '<td'.$align.' data-heading="'.self::escapeAttribute($heading).'">'.
      $this->renderNodes($cell).
      '</td>';
  }
}
