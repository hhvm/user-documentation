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

use type HHVM\UserDocumentation\{UnifiedIndexData, YAMLMeta};

use namespace Facebook\Markdown\Inlines;
use namespace HH\Lib\{Regex, Str, Vec};

/**
 * Given something like `Vec\map()`, automatically make it a link
 */
final class AutoLinkifyInline extends Inlines\Link {
  private static bool $disabled = false;

  <<__Override>>
  public static function consume(
    Inlines\Context $context,
    string $markdown,
    int $offset,
  ): ?(Inlines\Link, int) {
    if (self::$disabled) {
      return null;
    }

    // If there is a link at the current position, parse it using the standard
    // Inlines\Link, but with auto-linkifying disabled because nested links are
    // invalid HTML.
    self::$disabled = true;
    try {
      $result = Inlines\Link::consume($context, $markdown, $offset);
    } finally {
      self::$disabled = false;
    }
    if ($result is nonnull) {
      return $result;
    }

    $result = Inlines\CodeSpan::consume($context, $markdown, $offset);
    if ($result === null) {
      return null;
    }
    list($quoted, $offset) = $result;

    $content = $quoted->getCode();
    if ($content === null) {
      return null;
    }

    if (Str\starts_with($content, '$')) {
      return null;
    }

    $matches = Regex\first_match($content, re"/^[^(<]+/");
    if ($matches is null) {
      return null;
    }
    $definition = $matches[0];

    if (Str\contains($definition, ' ')) {
      return null;
    }

    $block_context = $context->getBlockContext();
    invariant(
      $block_context is BlockContext,
      'Expected block context to be a %s',
      BlockContext::class,
    );
    $meta = $block_context->getYamlMeta();

    $name = ($meta['name'] ?? null);
    if ($name !== null && Str\ends_with($name, $definition)) {
      return null;
    }

    $method = self::getMethodTarget($meta, $definition);

    $prefixes = vec[
      $meta['namespace'] ?? null,
      '',
      "HH",
      "HH\\Lib",
      "HH\\Lib\\Experimental",
    ]
      |> Vec\filter_nulls($$);

    $suffixes = vec[$definition, $method]
      |> Vec\filter_nulls($$);

    $to_try = self::product2($prefixes, $suffixes)
      |> Vec\map($$, $parts ==> {
        // Concat namespace parts and ignore parts that are empty
        list($prefix, $suffix) = $parts;
        return vec[$prefix, $suffix]
          |> Vec\filter($$, $part ==> !Str\is_empty($part))
          |> Str\join($$, '\\');
      });

    $index = self::getIndex();

    foreach ($to_try as $def) {
      $target = $index[$def] ?? null;
      if ($target !== null) {
        return tuple(self::makeAutoLink($quoted, $target), $offset);
      }
    }

    return null;
  }

  private static function product2<Tv1, Tv2>(
    Traversable<Tv1> $first,
    Traversable<Tv2> $second,
  ): Iterator<(Tv1, Tv2)> {
    foreach ($first as $f) {
      foreach ($second as $s) {
        yield tuple($f, $s);
      }
    }
  }

  private static function getMethodTarget(
    ?YAMLMeta $yaml,
    string $def,
  ): ?string {
    if ($yaml === null) {
      return null;
    }
    if (Str\contains($def, '::')) {
      return null;
    }
    $class = $yaml['class'] ?? null;
    if ($class === null) {
      return null;
    }

    return $class.'::'.Str\strip_prefix($def, '::');
  }

  private static function makeAutoLink(
    Inlines\CodeSpan $code,
    string $target,
  ): Inlines\Link {
    return new Inlines\Link(vec[$code], $target, null);
  }

  <<__Memoize>>
  private static function getIndex(): dict<string, string> {
    return UnifiedIndexData::getIndex();
  }
}
