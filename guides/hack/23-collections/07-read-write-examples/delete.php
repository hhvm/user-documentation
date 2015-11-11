<?hh

namespace Hack\UserDocumentation\Collections\ReadWrite\Examples\Delete;

function run(): void {
  $vec = Vector {'A', 'B', 'C'};
  $vec->removeKey(1);
  var_dump($vec[1]); // 'C' because its index is shifted back one

  $map = Map {'A' => 1, 'B' =>2};
  $map->removeKey('B');
  var_dump($map->containsKey('B'));

  $set = Set {1000, 2000, 3000, 4000};
  $set->remove(3000);
  var_dump($set);
}

run();
