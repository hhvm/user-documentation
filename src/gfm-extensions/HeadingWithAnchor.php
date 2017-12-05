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

use type HHVM\UserDocumentation\YAMLMeta;
use namespace Facebook\GFM;
use namespace HH\Lib\{C, Str, Vec};

final class HeadingWithAnchor
extends GFM\Blocks\LeafBlock
implements GFM\RenderableAsHTML {
  public function __construct(
    private int $level,
    private vec<GFM\Inlines\Inline> $heading,
    private string $id,
  ) {
  }

  public function getLevel(): int {
    return $this->level;
  }

  public function getID(): string {
    return $this->id;
  }

  public function renderAsHTML(
    GFM\RenderContext $ctx,
    GFM\HTMLRenderer $renderer,
  ): string {
    $contents = $this->heading
      |> Vec\map($$, $part ==> $renderer->render($part))
      |> Str\join($$, '');
    $id = GFM\_Private\plain_text_to_html_attribute($this->id);
    return
      '<h'.$this->level.
      ' class="headingWithAnchor"'.
      ' id="'.$id.'">'.
      $contents.
      '<a href="#'.$id.'"><i class="glyphIcon fa fa-link"></i></a>'.
      '</h'.$this->level.">\n";
  }
}
