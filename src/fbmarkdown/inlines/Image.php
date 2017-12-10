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

namespace Facebook\Markdown\Inlines;

use function Facebook\Markdown\_Private\{
  consume_link_destination,
  consume_link_title,
};
use namespace HH\Lib\{Str, Vec};

final class Image extends Inline {
  <<__Override>>
  public function getContentAsPlainText(): string {
    return '';
  }

  public function __construct(
    private vec<Inline> $description,
    private string $source,
    private ?string $title,
  ) {
  }

  public function getDescription(): vec<Inline> {
    return $this->description;
  }

  public function getSource(): string {
    return $this->source;
  }

  public function getTitle(): ?string {
    return $this->title;
  }

  <<__Override>>
  public static function consume(
    Context $context,
    string $_previous,
    string $string,
  ): ?(Inline, string, string) {
    if (!Str\starts_with($string, '![')) {
      return null;
    }

    $link = Link::consumeLinkish(
      $context,
      Str\slice($string, 1),
      keyset[Link::class],
    );

    if ($link === null) {
      return null;
    }

    list($link, $last, $rest) = $link;
    return tuple(
      new self(
        $link->getText(),
        $link->getDestination(),
        $link->getTitle(),
      ),
      $last,
      $rest,
    );
  }
}
