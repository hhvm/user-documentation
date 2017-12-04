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

namespace Facebook\GFM\Inlines\_Private\EmphasisStack;

use namespace Facebook\GFM\Inlines;
use type Facebook\GFM\Inlines\{Context, Inline};

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

  public function toInlines(Context $ctx): vec<Inline> {
    return Inlines\parse($ctx, $this->getText());
  }
}

class DelimiterNode extends TextNode {
  public function __construct(
    string $text,
    private int $flags,
    private string $rest,
  ) {
    parent::__construct($text);
  }

  public function getFlags(): int {
    return $this->flags;
  }

  public function getRest(): string {
    return $this->rest;
  }
}

class InlineNode extends Node {
  public function __construct(
    private Inline $content,
  ) {
  }

  public function toInlines(Context $_): vec<Inline> {
    return vec[$this->content];
  }
}

class EmphasisNode extends Node {
  public function __construct(
    private Inlines\Emphasis $content,
    private string $last,
    private string $rest,
  ) {
  }

  public function getContent(): Inlines\Emphasis {
    return $this->content;
  }

  public function toInlines(Context $_): vec<Inline> {
    return vec[$this->content];
  }

  public function getLast(): string {
    return $this->last;
  }

  public function getRest(): string {
    return $this->rest;
  }
}
