<?hh

namespace Hack\UserDocumentation\Callables\SpecialFunctions\Examples\LambdaPP;

class Foo {
  public function dump(): void {
    $vec = Vector { 'herp', 'derp' };
    var_dump($vec->map($in ==> $this->wrap($in)));

    // This is not allowed because inst_meth() can not access private methods
    // var_dump($vec->map(inst_meth($this, 'wrap')));
  }

  private function wrap(string $in): string {
    return '<<<'.$in.'>>>';
  }
}

function main() {
  (new Foo())->dump();
}

main();
