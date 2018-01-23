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
  $parser = FileParser::FromFile($file);
  $documentables = Documentables\from_parser($parser);

  if ($symbol !== null) {
    $documentables = Vec\filter(
      $documentables,
      $documentable ==> $documentable['definition']->getName() === $symbol
        || \sprintf(
          '%s::%s',
          $documentable['parent']?->getName(),
          $documentable['definition']->getName(),
        ) === $symbol,
    );
  }

  $md = new MarkdownBuilder();
  print(
    $documentables
    |> Vec\map($$, $def ==> $md->getDocumentation($def))
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
