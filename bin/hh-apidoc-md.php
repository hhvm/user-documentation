<?hh
/*
 *  Copyright (c) 2004-present, Facebook, Inc.
 *  All rights reserved.
 *
 *  This source code is licensed under the BSD-style license found in the
 *  LICENSE file in the root directory of this source tree. An additional grant
 *  of patent rights can be found in the PATENTS file in the same directory.
 *
 */

namespace Facebook\HHAPIDoc;

require_once(__DIR__.'/../vendor/hh_autoload.php');

use type Facebook\DefinitionFinder\{
  FileParser,
  ScannedClass,
};
use namespace HH\Lib\{C, Str, Vec};

/** Test CLI for dumping the markdown for a given definition. */
function cli_dump(string $file, ?string $symbol): void {
  $parsed = FileParser::FromFile($file);
  $defs = Vec\concat(
    $parsed->getClasses(),
    $parsed->getInterfaces(),
    $parsed->getTraits(),
    $parsed->getFunctions(),
  ) |> Vec\map(
    $$,
    $def ==> $def instanceof ScannedClass
      ? (Vec\concat(vec[$def], $def->getMethods()))
      : vec[$def]
  ) |> Vec\flatten($$);

  if ($symbol !== null) {
    $def = C\find($defs, $def ==> $def->getName() === $symbol);
    if ($def === null) {
      $def = C\find($defs, $def ==> Str\ends_with($def->getName(), $symbol));
    }

    if ($def === null) {
      $defs = vec[];
    } else {
      $defs = vec[$def];
    }
  }

  $md = new MarkdownBuilder();
  print(
    $defs
    |> Vec\map($$, $def ==> $md->getDocumentationForDefinition($def))
    |> Str\join($$, "\n")
    |> $$."\n"
  );
}

$file = $argv[1] ?? '/dev/stdin';
$symbol = $argv[2] ?? null;

if ($file === '--help') {
  fprintf(stderr, "USAGE: %s FILE [symbol]\n", $argv[0]);
  exit(1);
}

print(cli_dump($file, $symbol));
