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

use namespace Facebook\Markdown\Blocks;
use namespace HH\Lib\{C, Str, Vec};
use type Facebook\Markdown\{ASTNode, RenderContext, RenderFilter};

final class HeadingAnchorsFilter extends RenderFilter {
  private vec<HeadingWithAnchor> $previous = vec[];

  <<__Override>>
  public function resetFileData(): this {
    $this->previous = vec[];
    return $this;
  }

  <<__Override>>
  public function filter(RenderContext $_, ASTNode $heading): vec<ASTNode> {
    if (!$heading is Blocks\Heading) {
      return vec[$heading];
    }

    $id_prefix = '';
    if ($heading->getLevel() > 1) {
      for ($i = C\count($this->previous) - 1; $i >= 0; --$i) {
        $last = $this->previous[$i];
        if ($last->getLevel() < $heading->getLevel()) {
          $id_prefix = $last->getID().'__';
          break;
        }
      }
    }

    $id = $heading->getHeading()
      |> Vec\map($$, $inline ==> $inline->getContentAsPlainText())
      |> Str\join($$, '')
      |> \preg_replace('/\s+/', '-', $$)
      |> \preg_replace('/[^a-zA-Z0-9_\.-]/', '', $$)
      |> Str\lowercase($$)
      |> $id_prefix.$$;

    $with_anchor = new HeadingWithAnchor(
      $heading->getLevel(),
      $heading->getHeading(),
      $id,
    );
    $this->previous[] = $with_anchor;
    return vec[$with_anchor];
  }
}
