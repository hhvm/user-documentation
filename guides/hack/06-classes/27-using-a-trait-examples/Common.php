<?hh

namespace Hack\UserDocumentation\Classes\Traits\Examples\Common;

trait Common {
  private int $size = 1000;
  public function compute(): void { /* ... */ }
  public static function getData(): int { /* ... */
    return 0;
  }
}

trait T1 { /* ... */ }
trait T2 { /* ... */ }
trait T3 { /* ... */ }
trait T4 {
  use T3;
  use T1, T2;
  // ...
}

class C {
  use T3;
  use T1, Common;
  // ...
}
