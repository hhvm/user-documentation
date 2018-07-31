<?hh // strict

namespace Hack\UserDocumentation\Collections\HackArrays\Examples\Operations;

use namespace HH\Lib\{C, Dict, Keyset, Vec};

function main(): void {
  $ints = vec[1, 2, 3];
  $squared = Vec\map($ints, $x ==> $x * $x);
  \var_dump($squared);

  $ints = dict['one' => 1, 'two' => 2, 'three' => 3, 'four' => 4];
  $evens = Dict\filter($ints, $x ==> $x % 2 === 0);
  \var_dump($evens);
}

/* HH_IGNORE_ERROR[1002] top-level statement in strict file*/
main();
