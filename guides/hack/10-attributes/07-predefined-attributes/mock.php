<?hh // strict

namespace Hack\UserDocumentation\Attributes\__MockClass\Examples\MockClass;

final class FinalClass {
  public static function f(): void { echo __METHOD__, "\n"; }
}

// Without this attribute HHVM would throw a fatal error since you are trying
// to extend a final class. With it, you can run the code as you normally would.
// That said, you will still get Hack typechecker errors, since it does not
// recognize this attribute as anything intrinsic, but these can be suppressed.

/* HH_IGNORE_ERROR [2049] */
<<__MockClass>>
/* HH_IGNORE_ERROR [4035] */
final class MockFinalClass extends FinalClass {
  public static function f(): void {
    echo __METHOD__, "\n";
    
    // Let's say we were testing the call to the parent class. We wouldn't
    // be able to do this in HHVM without the __MockClass attribute.
    parent::f();
  }
}

<<__EntryPoint>>
function main(): void {
  $o = new MockFinalClass();
  $o::f();
}
