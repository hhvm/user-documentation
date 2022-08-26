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
      GuidesProduct::HHVM => dict[
        'getting-started' => tuple('basic-usage', 'introduction'),
      ],
      GuidesProduct::HACK => dict[
        'async' => tuple('asynchronous-operations', null),
        'collections' => tuple('arrays-and-collections', 'introduction'),
        'disposables' => tuple('classes', 'object-disposal'),
        'enums' => tuple('built-in-types', 'enum'),
        'lambdas' => tuple('functions', 'anonymous-functions'),
        'operators' => tuple('expressions-and-operators', null),
        'overview' => tuple('getting-started', null),
        'shapes' => tuple('built-in-types', 'shape'),
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
      GuidesProduct::HHVM => dict[
        'getting-started' => dict[
          'getting-started' => tuple('basic-usage', 'introduction'),
        ],
      ],
      GuidesProduct::HACK => dict[
        'getting-started' => dict[
          'the-standard-library' => tuple('getting-started', 'the-hack-standard-library'),
        ],
        'arrays-and-collections' => dict[
          'hack-arrays' => tuple('arrays-and-collections', 'vec-keyset-and-dict'),
          'collections' => tuple('arrays-and-collections', 'object-collections'),
          'php-arrays' => tuple('arrays-and-collections', 'varray-and-darray'),
        ],
        'async' => dict[
          'async-vs-awaitable' =>
            tuple('asynchronous-operations', 'introduction'),
          'awaitables' => tuple('asynchronous-operations', 'awaitables'),
          'exceptions' => tuple('asynchronous-operations', 'exceptions'),
          'extensions' => tuple('asynchronous-operations', 'extensions'),
          'utility-functions' =>
            tuple('asynchronous-operations', 'utility-functions'),
        ],
        'asynchronous-operations' => dict[
          'await-as-an-expression-spec' => tuple('asynchronous-operations', 'await-as-an-expression'),
          'further-resources' => tuple('asynchronous-operations', 'introduction'),
          'some-basics' => tuple('asynchronous-operations', 'introduction'),
          'async-vs.-awaitable' => tuple('asynchronous-operations', 'introduction'),
          'blocks' => tuple('asynchronous-operations', 'async-blocks'),
        ],
        'attributes' => dict[
          'special' => tuple('attributes', 'predefined-attributes'),
          'syntax' => tuple('attributes', 'introduction'),
          'some-basics' => tuple('attributes', 'introduction'),
          'attribute-specification' => tuple('attributes', 'introduction'),
        ],
        'built-in-types' => dict[
          'arrays' => tuple('arrays-and-collections', 'introduction'),
          'function' => tuple('functions', 'introduction'),
          'enumerated-types' => tuple('built-in-types', 'enum'),
          'shapes' => tuple('built-in-types', 'shape'),
        ],
        'callables' => dict[
          'special-functions' => tuple('functions', 'anonymous-functions'),
        ],
        'classes' => dict[
          'some-basics' => tuple('classes', 'introduction'),
          'defining-a-basic-class' => tuple('classes', 'introduction'),
	  'implementing-an-interface' => tuple('traits-and-interfaces', 'implementing-an-interface'),
	  'trait-and-interface-requirements' => tuple('traits-and-interfaces', 'trait-and-interface-requirements'),
	  'using-a-trait' => tuple('traits-and-interfaces', 'using-a-trait'),

	],
        'disposables' => dict[
          'introduction' => tuple('classes', 'object-disposal'),
        ],
        'expressions-and-operators' => dict[
          'addition' => tuple('expressions-and-operators', 'arithmetic'),
          'as' => tuple('expressions-and-operators', 'type-assertions'),
          'async-blocks' => tuple('asynchronous-operations', 'blocks'),
          'banning-lval-as-an-expression' => tuple('expressions-and-operators', 'introduction'),
          'bitwise-AND' => tuple('expressions-and-operators', 'bitwise-operators'),
          'bitwise-exclusive-OR' => tuple('expressions-and-operators', 'bitwise-operators'),
          'bitwise-inclusive-OR' => tuple('expressions-and-operators', 'bitwise-operators'),
          'bitwise-left-shift' => tuple('expressions-and-operators', 'bitwise-operators'),
          'bitwise-right-shift' => tuple('expressions-and-operators', 'bitwise-operators'),
          'closure-creation' => tuple('functions', 'anonymous-functions'),
          'conditional' => tuple('expressions-and-operators', 'ternary'),
          'division' => tuple('expressions-and-operators', 'arithmetic'),
          'exponentiation' => tuple('expressions-and-operators', 'arithmetic'),
          'function-call' => tuple('functions', 'introduction'),
          'instanceof' => tuple('expressions-and-operators', 'type-assertions'),
          'is' => tuple('expressions-and-operators', 'type-assertions'),
          'lambda-creation' => tuple('functions', 'anonymous-functions'),
          'logical-AND' => tuple('expressions-and-operators', 'logical-operators'),
          'logical-inclusive-OR' => tuple('expressions-and-operators', 'logical-operators'),
          'logical-NOT' => tuple('expressions-and-operators', 'logical-operators'),
          'multiplication' => tuple('expressions-and-operators', 'arithmetic'),
          'null-safe-member-selection' => tuple('expressions-and-operators', 'member-selection'),
          'ones-complement' => tuple('expressions-and-operators', 'bitwise-operators'),
          'operations-on-operands-having-one-or-more-subtypes' => tuple('types', 'type-refinement'),
          'relational' => tuple('expressions-and-operators', 'comparisons'),
          'restrictions-on-arithmetic-operations' => tuple('expressions-and-operators', 'arithmetic'),
          'remainder' => tuple('expressions-and-operators', 'arithmetic'),
          'some-basics' => tuple('expressions-and-operators', 'introduction'),
          'subtraction' => tuple('expressions-and-operators', 'arithmetic'),
          'unary-minus' => tuple('expressions-and-operators', 'arithmetic'),
          'unary-plus' => tuple('expressions-and-operators', 'arithmetic'),
          'XHP-attribute-spread' => tuple('XHP', 'introduction'),
          'readonly' => tuple('readonly', 'introduction')
        ],
        'functions' => dict[
          'defining-a-function' => tuple('functions', 'introduction'),
          'some-basics' => tuple('functions', 'introduction'),
          'calling-a-function' => tuple('functions', 'format-strings'),
        ],
        'generics' => dict[
          'constraints' => tuple('generics', 'type-constraints'),
          'open-and-closed-generic-types' => tuple('generics', 'type-erasure'),
          'reified-generics' => tuple('reified-generics', 'reified-generics'),
          'reified-generics-migration' => tuple('reified-generics', 'reified-generics-migration'),
          'some-basics' => tuple('generics', 'introduction'),
	        'type-arguments' => tuple('generics', 'type-parameters'),
        ],
        'operators' => dict[
          'lambda' => tuple('functions', 'anonymous-functions'),
          'pipe' => tuple('expressions-and-operators', 'pipe'),
          'nullsafe' =>
            tuple('expressions-and-operators', 'member-selection'),
        ],
        'other-features' => dict[
          'autoloading' =>
            tuple('source-code-fundamentals', 'script-inclusion'),
          'constructor-parameter-promotion' => tuple('classes', 'constructors'),
          'placeholder-variable' => tuple('source-code-fundamentals', 'names'),
          'variadic-functions' => tuple('functions', 'introduction'),
        ],
        'overview' => dict[
          'typing' => tuple('types', 'introduction'),
        ],
        'source-code-fundamentals' => dict[
          'white-space' => tuple('source-code-fundamentals', 'introduction'),
          'operators-and-punctuators' => tuple('source-code-fundamentals', 'introduction'),
        ],
        'statements' => dict[
          'compound-statements' => tuple('statements', 'introduction'),
          'expression-statements' => tuple('expressions-and-operators', 'introduction'),
          'labeled-statements' => tuple('statements', 'switch'),
          'throw' => tuple('statements', 'try'),
        ],
        'typechecker' => dict[
          'editors' => tuple('getting-started', 'tools'),
          'modes' => tuple('source-code-fundamentals', 'program-structure'),
        ],
        'types' => dict[
          'anonymous-function-objects' => tuple('functions', 'anonymous-functions'),
          'annotations' => tuple('functions', 'introduction'),
          'arraykey' => tuple('built-in-types', 'arraykey'),
          'arrays' => tuple('arrays-and-collections', 'introduction'),
          'bool' => tuple('built-in-types', 'bool'),
          'casting' => tuple('types', 'type-conversion'),
          'classes' => tuple('classes', 'introduction'),
          'classname' => tuple('built-in-types', 'classname'),
          'dynamic' => tuple('built-in-types', 'dynamic'),
          'enumerated-types' => tuple('built-in-types', 'enum'),
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
          'shapes' => tuple('built-in-types', 'shape'),
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
