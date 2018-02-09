<?hh

namespace Hack\UserDocumentation\TypeConstants\Exampes\Examples\Instance;

abstract class Box {
  abstract const type T;
  public function __construct(private this::T $value) {}
  public function get(): this::T {
    return $this->value;
  }
  public function set(this::T $val): this {
    $this->value = $val;
    return $this;
  }
}

class IntBox extends Box {
  const type T = int;
}

function run(): void {
  $ibox = new IntBox(10);
  $ibox->set(11);
  \var_dump($ibox);
  invariant($ibox instanceof Box, 'Upcast to Box');
  \var_dump($ibox);
  // CHECK THIS -- THIS SHOULD (?) ERROR BUT THE TYPECHECKER IS NOT CATCHING IT
  // This will be an error because 'this::T' in '$box' may not be an int
  $ibox->set(1337);
  \var_dump($ibox);
  // This is not an error because the type checker knows that the type
  // returned by $box->get(), is the same accepted by $box->set()
  $ibox->set($ibox->get());
  \var_dump($ibox);
}

run();
