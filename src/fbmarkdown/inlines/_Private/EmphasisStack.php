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

namespace Facebook\Markdown\Inlines\_Private\EmphasisStack;

use namespace Facebook\Markdown\Inlines;
use type Facebook\Markdown\Inlines\{Context, Inline};

abstract class Node {
  abstract public function toInlines(Context $ctx): vec<Inline>;
}

class TextNode extends Node {
  public function __construct(
    private string $text,
  ) {
  }

  public function getText(): string {
    return $this->text;
  }

  <<__Override>>
  public function toInlines(Context $ctx): vec<Inline> {
    return Inlines\parse($ctx, $this->getText());
  }
}

class DelimiterNode extends TextNode {
  public function __construct(
    string $text,
    private int $flags,
    private int $startOffset,
    private int $endOffset,
  ) {
    parent::__construct($text);
  }

  public function getFlags(): int {
    return $this->flags;
  }

  public function getStartOffset(): int {
    return $this->startOffset;
  }

  public function getEndOffset(): int {
    return $this->endOffset;
  }
}

class InlineNode extends Node {
  public function __construct(
    private Inline $content,
  ) {
  }

  <<__Override>>
  public function toInlines(Context $_): vec<Inline> {
    return vec[$this->content];
  }
}

class EmphasisNode extends Node {
  public function __construct(
    private Inlines\Emphasis $content,
    private int $startOffset,
    private int $endOffset,
  ) {
  }

  public function getContent(): Inlines\Emphasis {
    return $this->content;
  }

  <<__Override>>
  public function toInlines(Context $_): vec<Inline> {
    return vec[$this->content];
  }

  public function getStartOffset(): int {
    return $this->startOffset;
  }

  public function getEndOffset(): int {
    return $this->endOffset;
  }
}
