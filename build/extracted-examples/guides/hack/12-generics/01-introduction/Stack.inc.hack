// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\Generics\Introduction\Stack;

use namespace HH\Lib\{C, Vec};

interface StackLike<T> {
  public function isEmpty(): bool;
  public function push(T $element): void;
  public function pop(): T;
}

class StackUnderflowException extends \Exception {}

class VecStack<T> implements StackLike<T> {
  private int $stackPtr;

  public function __construct(private vec<T> $elements = vec[]) {
    $this->stackPtr = C\count($elements) - 1;
  }

  public function isEmpty(): bool {
    return $this->stackPtr === -1;
  }

  public function push(T $element): void {
    $this->stackPtr++;
    if (C\count($this->elements) === $this->stackPtr) {
      $this->elements[] = $element;
    } else {
      $this->elements[$this->stackPtr] = $element;
    }
  }

  public function pop(): T {
    if ($this->isEmpty()) {
      throw new StackUnderflowException();
    }
    $element = $this->elements[$this->stackPtr];
    $this->elements[$this->stackPtr] = $this->elements[0];
    $this->stackPtr--;
    return $element;
  }
}
