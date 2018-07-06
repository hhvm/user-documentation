<?hh

namespace Hack\UserDocumentation\Generics\Entities\Examples\Functions;

function nullthrows<T as nonnull>(?T $v): T {
  invariant($v !== null, 'unexpected null');
  return $v;
}

function run(): void {
  \var_dump(nullthrows(123));
  \var_dump(nullthrows('abc'));
  nullthrows(null);
}

run();
