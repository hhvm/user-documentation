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

namespace HHVM\UserDocumentation\GFM;

use namespace Facebook\GFM;
use namespace HH\Lib\{C, Str, Vec};

final class HTMLRenderer extends GFM\HTMLRenderer {
  <<__Override>>
  protected function renderTableExtension(
    GFM\Blocks\TableExtension $table,
  ): string {
    return
      '<div class="tableWrapper">'.
      parent::renderTableExtension($table).
      '</div>';
  }

  protected function renderTableDataCell(
    GFM\Blocks\TableExtension $table,
    int $_row_idx,
    int $col_idx,
    GFM\Blocks\TableExtension::TCell $cell,
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
