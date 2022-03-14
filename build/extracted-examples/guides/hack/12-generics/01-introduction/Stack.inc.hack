// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\Generics\Introduction\Stack;

class StackUnderflowException extends \Exception {}
use namespace HH\Lib\C;

class Stack<T> {
  private vec<T> $stack;

  public function __construct() {
    $this->stack = vec[];
  }

  public function push(T $value): void {
    $this->stack[] = $value;
  }

  public function pop(): T {
    $stack = $this->stack;
    if (!C\is_empty($stack)) {
      return C\pop_backx(inout $stack);
    } else {
      throw new StackUnderflowException();
    }
  }
}
