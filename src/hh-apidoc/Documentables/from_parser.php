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

namespace Facebook\HHAPIDoc\Documentables;

use type Facebook\DefinitionFinder\BaseParser;
use type Facebook\HHAPIDoc\Documentables;

use namespace HH\Lib\{Dict, Vec};

function from_parser(BaseParser $parser): Documentables {
  $classes = Vec\concat(
    $parser->getClasses(),
    $parser->getInterfaces(),
    $parser->getTraits(),
  );
  $methods = $classes
    |> Vec\map(
      $$,
      $class ==> Vec\map(
        $class->getMethods(),
        $method ==> tuple($class, $method),
      ),
    )
    |> Vec\flatten($$);
  $top_level = Vec\concat(
    $classes,
    $parser->getFunctions(),
  );
  return Vec\concat(
    Vec\map(
      $top_level,
      $def ==> tuple(
        $def->getName(),
        shape(
          'sources' => vec[$def->getFileName()],
          'definition' => $def,
          'parent' => null,
        ),
      ),
    ),
    Vec\map(
      $methods,
      $class_and_method ==> {
        list($class, $method) = $class_and_method;
        return tuple(
          $class->getName().'::'.$method->getName(),
          shape(
            'sources' => vec[$method->getFileName()],
            'definition' => $method,
            'parent' => $class,
          ),
        );
      }
    ),
  ) |> Dict\from_entries($$);
}
