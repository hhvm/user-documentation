// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\Generics\Introduction\Stack;

interface StackLike<T> {
    public function push(T $element): void;
    public function pop(): T;
}

class StackUnderflowException extends \Exception {}


class VecStack<T> implements StackLike<T> {
    private vec<T> $elements = vec[];
    private int $size = 0, $capacity = 0;

    public function push(T $element): void {
        if ($this->size === $this->capacity) {
            $this->elements[] = $element;
            $this->capacity++;
        } else {
            $this->elements[$this->size] = $element;
        }
        $this->size++;
    }

    public function pop(): T {
        if ($this->size > 0) {
            $this->size--;
            return $this->elements[$this->size];
        }
        throw new StackUnderflowException();
    }
}
