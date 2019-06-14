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
        'enums' => tuple('built-in-types', 'enumerated-types'),
        'generics' => tuple('types', 'generic-types'),
        'lambdas' => tuple('functions', 'anonymous-functions'),
        'operators' => tuple('expressions-and-operators', null),
        'overview' => tuple('getting-started', null),
        'shapes' => tuple('built-in-types', 'shapes'),
        'tools' => tuple('getting-started', 'tools'),
        'tuples' => tuple('built-in-types', 'tuples'),
        'typechecker' => tuple('getting-started', 'tools'),
        'type-aliases' => tuple('types', 'type-aliases'),
        'type-constants' => tuple('classes', 'type-constants'),
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
        'attributes' => dict[
          'special' => tuple('attributes', 'predefined-attributes'),
          'syntax' => tuple('attributes', 'attribute-specification'),
        ],
        'callables' => dict[
          'special-functions' => tuple('types', 'anonymous-function-objects'),
        ],
        'operators' => dict[
          'lambda' => tuple('functions', 'anonymous-functions'),
          'pipe' => tuple('expressions-and-operators', 'pipe'),
          'nullsafe' =>
            tuple('expressions-and-operators', 'null-safe-member-selection'),
        ],
        'other-features' => dict[
          'autoloading' =>
            tuple('source-code-fundamentals', 'script-inclusion'),
          'constructor-parameter-promotion' => tuple('classes', 'constructors'),
          'placeholder-variable' => tuple('source-code-fundamentals', 'names'),
          'trait-and-interface-requirements' =>
            tuple('classes', 'trait-and-interface-requirements'),
          'variadic-functions' => tuple('functions', 'defining-a-function'),
        ],
        'overview' => dict[
          'typing' => tuple('types', 'introduction'),
        ],
        'typechecker' => dict[
          'editors' => tuple('getting-started', 'tools'),
          'modes' => tuple('source-code-fundamentals', 'program-structure'),
        ],
        'types' => dict[
          'annotations' => tuple('functions', 'defining-a-function'),
          'casting' => tuple('types', 'type-conversion'),
          'inference' => tuple('types', 'type-inferencing'),
          'refining' => tuple('types', 'type-refinement'),
          'summary-table' => tuple('types', null),
          'type-system' => tuple('types', null),
        ],
      ],
    ][$product] ??
      dict[];
  }

}
