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

namespace HHVM\UserDocumentation;

final class Guides {
  public static function normalizeName(
    GuidesProduct $product,
    string $guide,
    string $page,
  ): string {
    // If the guide name and the page name are the same, only print one of them.
    // If there is only one page in a guide, only print the guide name.
    return (
      \strcasecmp($guide, $page) === 0 ||
      \count(GuidesIndex::getPages($product, $guide)) === 1
    )
      ? \ucwords(\strtr($guide, '-', ' '))
      : \ucwords(\strtr($guide.': '.$page, '-', ' '));
  }

  public static function normalizePart(string $part): string {
    return \ucwords(\strtr($part, '-', ' '));
  }

  public static function getGuideRedirects(
    GuidesProduct $product,
  ): dict<string, (string, ?string)> {
    return dict[
      GuidesProduct::HACK => dict[
        'async' => tuple('asynchronous-operations', null),
        'collections' => tuple('types', 'arrays'),
        'overview' => tuple('getting-started', null),
        'tools' => tuple('getting-started', 'tools'),
      ],
    ][$product] ??
      dict[];
  }

  public static function getGuidePageRedirects(
    GuidesProduct $product,
  ): dict<string, dict<string, (string, ?string)>> {
    return dict[
      GuidesProduct::HACK => dict[
        'async' => dict[
          'async-vs-awaitable' =>
            tuple('asynchronous-operations', 'async-vs.-awaitable'),
          'awaitables' => tuple('asynchronous-operations', 'awaitables'),
          'exceptions' => tuple('asynchronous-operations', 'exceptions'),
          'extensions' => tuple('asynchronous-operations', 'extensions'),
          'utility-functions' =>
            tuple('asynchronous-operations', 'utility-functions'),
        ],
        'other-features' => dict[
          'constructor-parameter-promotion' => tuple('classes', 'constructors'),
        ],
        'overview' => dict[
          'typing' => tuple('types', 'introduction'),
        ],
      ],
    ][$product] ??
      dict[];
  }

}
