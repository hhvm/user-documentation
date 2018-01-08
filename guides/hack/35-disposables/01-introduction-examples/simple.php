<?hh // strict

namespace Hack\UserDocumentation\Examples\Intro\Examples\Simple;

class Handle implements \IDisposable {
  public function __dispose(): void {}
  public function foo(): void {}
}

function disposable_example(): void {
  // Block scope
  using ($x = new Handle()) {
    $x->foo();
  } // $x->__dispose() is implicitly called here

  // Function scope
  using new Handle();
  // handle still exists here
} // __dispose() is now called on the anonymous handle
