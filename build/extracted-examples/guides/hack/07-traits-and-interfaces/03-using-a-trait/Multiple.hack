// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\TraitsAndInterfaces\UsingATrait\Multiple;

trait T1 {
  public int $x = 0;

  public function return_even() : int {
    invariant($this->x % 2 == 0, 'error, not even\n');
    $this->x = $this->x + 2;
    return $this->x;
  }
}

trait T2 {
  use T1;

  public function return_odd() : int {
    return $this->return_even() + 1;
  }
}

trait T3 {
  public static function is_odd(int $x) : bool {
    if ($x % 2 == 1) {
      return true;
    } else {
      return false;
    }
  }
}

class C {
  use T2;
  use T3;

  public function foo() : void {
    echo static::is_odd($this->return_odd()) . "\n";
  }
}

<<__EntryPoint>>
function main() : void {
  \init_docs_autoloader();

  (new C()) -> foo();
}
