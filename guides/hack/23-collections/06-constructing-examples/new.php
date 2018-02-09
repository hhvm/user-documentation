<?hh

namespace Hack\UserDocumentation\Collections\Constructing\Examples\UsingNew;

function convert(array<int> $arr): Vector<int> {
  \var_dump($arr instanceof Traversable);
  return new Vector($arr);
}

function run(): void {
  $arr = array(1, 2, 3);
  \var_dump(convert($arr));
}

run();
