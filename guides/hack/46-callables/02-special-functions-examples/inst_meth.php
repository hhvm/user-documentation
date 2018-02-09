<?hh

namespace Hack\UserDocumentation\Callables\SpecialFunctions\Examples\InstMeth;

class Foo {
  public function bar() {
    \var_dump(__CLASS__.'->'.__FUNCTION__);
  }
}

function main() {
  $foo = new Foo();
  $x = inst_meth($foo, 'bar');
  $x();
}

main();
