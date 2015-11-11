<?hh

namespace Hack\UserDocumentation\TypeChecker\Running\Examples\Autoloading;

class A {
  private B $b;
  public function __construct(B $b) {
    $this->b = $b;
  }
  public function foo(): int {
    return $this->b->getSomeInt();
  }
}

function callFoo(): void {
  $a = new A(new B());
  var_dump($a->foo());

}

function myAutoloader(string $class): void {
  // Remove all the namespace stuff and just get the 'B'
  include __DIR__ . '/' . substr($class, -1) . '.inc.php';
}

spl_autoload_register(
  'Hack\UserDocumentation\TypeChecker\Running\Examples\Autoloading\myAutoloader'
);

callFoo();

/*

<?hh

namespace Hack\UserDocumentation\TypeChecker\Intro\Examples\Autoloading;

class B {
  public function getSomeInt(): int {
    return 5;
  }
}

*/
