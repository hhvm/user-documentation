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

namespace Facebook\GFM;

<<__ConsistentConstruct>>
abstract class Block<TChild as Node> extends Node {
  public function __construct(string $firstLine) {
  }
  abstract public static function isStartedByLine(string $_): bool;

  public function getContinuationPrefix(): ?string {
    return null;
  }

  abstract public function appendBlock(Block<Node> $_): void;
}
