<?hh

namespace Hack\UserDocumentation\Callables\SpecialFunctions\Examples\ClassMeth;

class Foo {
  public static function bar() {
    var_dump(__CLASS__.'::'.__FUNCTION__);
  }
}

function main() {
  $x = class_meth(Foo::class, 'bar');
  $x();

  $y = class_meth(
    '\Hack\UserDocumentation\Callables\SpecialFunctions\Examples\ClassMeth\Foo',
    'bar',
  );
  $y();
}

main();
