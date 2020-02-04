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
        'collections' => tuple('built-in-types', 'arrays'),
        'enums' => tuple('built-in-types', 'enumerated-types'),
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
        'expressions-and-operators' => dict[
          'addition' => tuple('expressions-and-operators', 'arithmetic'),
          'bitwise-AND' => tuple('expressions-and-operators', 'bitwise-operators'),
          'bitwise-exclusive-OR' => tuple('expressions-and-operators', 'bitwise-operators'),
          'bitwise-inclusive-OR' => tuple('expressions-and-operators', 'bitwise-operators'),
          'bitwise-left-shift' => tuple('expressions-and-operators', 'bitwise-operators'),
          'bitwise-right-shift' => tuple('expressions-and-operators', 'bitwise-operators'),
          'closure-creation' => tuple('functions', 'anonymous-functions'),
          'conditional' => tuple('expressions-and-operators', 'ternary'),
          'division' => tuple('expressions-and-operators', 'arithmetic'),
          'exponentiation' => tuple('expressions-and-operators', 'arithmetic'),
          'lambda-creation' => tuple('functions', 'anonymous-functions'),
          'multiplication' => tuple('expressions-and-operators', 'arithmetic'),
          'null-safe-member-selection' => tuple('expressions-and-operators', 'member-selection'),
          'ones-complement' => tuple('expressions-and-operators', 'bitwise-operators'),
          'operations-on-operands-having-one-or-more-subtypes' => tuple('types', 'type-refinement'),
          'relational' => tuple('expressions-and-operators', 'comparisons'),
          'restrictions-on-arithmetic-operations' => tuple('expressions-and-operators', 'arithmetic'),
          'remainder' => tuple('expressions-and-operators', 'arithmetic'),
          'subtraction' => tuple('expressions-and-operators', 'arithmetic'),
          'unary-minus' => tuple('expressions-and-operators', 'arithmetic'),
          'unary-plus' => tuple('expressions-and-operators', 'arithmetic'),
          'XHP-attribute-spread' => tuple('XHP', 'introduction'),
        ],
        'generics' => dict[
          'open-and-closed-generic-types' => tuple('generics', 'type-erasure'),
          'type-arguments' => tuple('generics', 'type-parameters'),
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
        'statements' => dict[
          'labeled-statements' => tuple('statements', 'switch'),
        ],
        'typechecker' => dict[
          'editors' => tuple('getting-started', 'tools'),
          'modes' => tuple('source-code-fundamentals', 'program-structure'),
        ],
        'types' => dict[
          'annotations' => tuple('functions', 'defining-a-function'),
          'arraykey' => tuple('built-in-types', 'arraykey'),
          'arrays' => tuple('built-in-types', 'arrays'),
          'bool' => tuple('built-in-types', 'bool'),
          'casting' => tuple('types', 'type-conversion'),
          'classname' => tuple('built-in-types', 'classname'),
          'dynamic' => tuple('built-in-types', 'dynamic'),
          'enumerated-types' => tuple('built-in-types', 'enumerated-types'),
          'float' => tuple('built-in-types', 'float'),
          'inference' => tuple('types', 'type-inferencing'),
          'int' => tuple('built-in-types', 'int'),
          'mixed' => tuple('built-in-types', 'mixed'),
          'nonnull' => tuple('built-in-types', 'nonnull'),
          'noreturn' => tuple('built-in-types', 'noreturn'),
          'null' => tuple('built-in-types', 'null'),
          'num' => tuple('built-in-types', 'num'),
          'refining' => tuple('types', 'type-refinement'),
          'resources' => tuple('built-in-types', 'resources'),
          'shapes' => tuple('built-in-types', 'shapes'),
          'string' => tuple('built-in-types', 'string'),
          'summary-table' => tuple('types', null),
          'this' => tuple('built-in-types', 'this'),
          'tuples' => tuple('built-in-types', 'tuples'),
          'type-system' => tuple('types', null),
          'void' => tuple('built-in-types', 'void'),
        ],
      ],
    ][$product] ??
      dict[];
  }

}
