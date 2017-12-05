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

namespace Facebook\Markdown;

use type Facebook\Markdown\UnparsedBlocks\Context as BlockContext;
use type Facebook\Markdown\Inlines\Context as InlineContext;
use type Facebook\Markdown\Blocks\Document as Document;

use namespace HH\Lib\Vec;

class RenderContext {
  private vec<RenderFilter> $filters = vec[];

  private ?Document $document;

  public function setDocument(Document $document): this {
    invariant(
      $this->document === null,
      'Call %s::resetFileData between files',
      static::class,
    );
    $this->document = $document;
    return $this;
  }

  public function getDocument(): Document {
    $doc = $this->document;
    invariant(
      $doc !== null,
      'call %s::setDocument before attempting to render',
      static::class,
    );
    return $doc;
  }

  public function resetFileData(): this {
    foreach ($this->filters as $filter) {
      $filter->resetFileData();
    }
    $this->document = null;
    return $this;
  }

  public function appendFilters(RenderFilter ...$filters): this {
    $this->filters = Vec\concat($this->filters, $filters);
    return $this;
  }

  public function transformNode(ASTNode $node): vec<ASTNode> {
    $nodes = vec[$node];
    foreach ($this->filters as $filter) {
      $nodes = $nodes
        |> Vec\map($$, $node ==> $filter->filter($this, $node))
        |> Vec\flatten($$);
    }
    return $nodes;
  }
}
