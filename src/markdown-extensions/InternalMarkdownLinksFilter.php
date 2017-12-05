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

use type Facebook\Markdown\{ASTNode, RenderContext, RenderFilter};
use namespace Facebook\Markdown\Inlines;
use namespace HH\Lib\Str;

final class InternalMarkdownLinksFilter extends RenderFilter {
  <<__Override>>
  public function filter(
    RenderContext $_,
    ASTNode $node,
  ): vec<ASTNode> {
    if ($node instanceof Inlines\Link) {
      return $this->filterLink($node);
    }
    if ($node instanceof Inlines\AutoLink) {
      return $this->filterAutoLink($node);
    }
    return vec[$node];
  }

  private function filterLink(Inlines\Link $link): vec<ASTNode> {
    $old = $link->getDestination();
    $new = $this->getNewDestination($old);
    if ($old === $new) {
      return vec[$link];
    }
    return vec[
      new Inlines\Link($link->getText(), $new, $link->getTitle())
    ];
  }

  private function filterAutoLink(Inlines\AutoLink $link): vec<ASTNode> {
    $old = $link->getDestination();
    $new = $this->getNewDestination($old);
    if ($old === $new) {
      return vec[$link];
    }
    return vec[
      new Inlines\AutoLink(
        $link->getText(),
        $new,
      )
    ];
  }

  private function getNewDestination(string $uri): string {
    if (!Str\ends_with($uri, '.md')) {
      return $uri;
    }
    $host = \parse_url($uri, PHP_URL_HOST);
    if ($host !== null) {
      return $uri;
    }
    return Str\strip_suffix($uri, '.md');
  }
}
