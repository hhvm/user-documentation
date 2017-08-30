<?hh

namespace Hack\UserDocumentation\Collections\HackArrays\Examples\Literals;

function main(): void {
  var_dump(vec[1, 2, 3, 1]);
  var_dump(dict['a' => ord('a'), 'b' => ord('b'), 'c' => ord('c')]);
  var_dump(keyset[1, 2, 3, 1]);
}

main();
