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

namespace Facebook\Markdown\Blocks;

use type Facebook\Markdown\Inlines\Inline;

enum TableExtensionColumnAlignment: string {
  LEFT = 'left';
  RIGHT = 'right';
  CENTER = 'center';
}

class TableExtension extends LeafBlock {
  const type TCell = vec<Inline>;
  const type TRow = vec<self::TCell>;
  public function __construct(
    private self::TRow $header,
    private vec<?TableExtensionColumnAlignment> $alignments,
    private vec<self::TRow> $data,
  ) {
  }

  public function getHeader(): self::TRow {
    return $this->header;
  }

  public function getData(): vec<self::TRow> {
    return $this->data;
  }

  public function getColumnAlignments(): vec<?TableExtensionColumnAlignment> {
    return $this->alignments;
  }
}
