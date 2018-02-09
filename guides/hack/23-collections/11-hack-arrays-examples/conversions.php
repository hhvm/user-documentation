<?hh

namespace Hack\UserDocumentation\Collections\HackArrays\Examples\Conversions;

function main(): void {
  \var_dump(vec(Vector { 1, 2, 3, 1 }));
  \var_dump(dict(Map {'a' => \ord('a'), 'b' => \ord('b'), 'c' => \ord('c') }));
  \var_dump(keyset(Vector {1, 2, 3, 1 }));
  \var_dump(keyset(Set {1, 2, 3, 1 }));
}

main();
