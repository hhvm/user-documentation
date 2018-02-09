<?hh

namespace Hack\UserDocumentation\Generics\Entities\Examples\Functions;

function maxVal<T>(T $p1, T $p2): T {
  return $p1 > $p2 ? $p1 : $p2;
}

function run(): void {
  \var_dump(maxVal(10, 20));
  \var_dump(maxVal(15.6, -20.78));
  \var_dump(maxVal('red', 'green'));
}

run();
