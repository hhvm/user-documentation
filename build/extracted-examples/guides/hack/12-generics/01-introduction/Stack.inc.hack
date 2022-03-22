// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\Generics\Introduction\Stack;

use namespace HH\Lib\Vec;

use namespace HH\Lib\C;

interface StackLike<T> {
    public function push(T $element): void;
    public function pop(): T;
}

class StackUnderflowException extends \Exception {}

class VecStack<T> implements StackLike<T> {
    private vec<T> $elements = vec[];

    public function push(T $element): void {
        $this->elements[] = $element;
    }

    public function pop(): T {
        $count = C\count($this->elements);
        if ($count > 0) {
            $element = $this->elements[$count - 1];
            Vec\drop($this->elements, $count - 1);
            return $element;
        }
        throw new StackUnderflowException();
    }
}
