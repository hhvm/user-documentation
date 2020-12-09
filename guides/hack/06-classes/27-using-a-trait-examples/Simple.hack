// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\Classes\UsingATrait\Simple;

trait T {
  public int $x = 0;

  public function return_even() : int {
    invariant($this->x % 2 == 0, 'error, not even\n');
    $this->x = $this->x + 2;
    return $this->x;
  }
}

class C1 {
  use T;

  public function foo() : void {
    echo "C1: " . $this->return_even() . "\n";
  }
}

class C2 {
  use T;

  public function bar() : void {
    echo "C2: " . $this->return_even() . "\n";
  }
}

<<__EntryPoint>>
function main() : void {
  \init_docs_autoloader();

  (new C1()) -> foo();
  (new C2()) -> bar();
}
