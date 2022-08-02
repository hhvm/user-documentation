// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\BuiltInTypes\EnumClass\EnumClassBox;

interface IBox {}

class Box<T> implements IBox {
  public function __construct(public T $data)[] {}
}

enum class Boxes: IBox {
  Box<int> Age = new Box(42);
  Box<string> Color = new Box('red');
  Box<int> Year = new Box(2021);
}

function get<T>(\HH\MemberOf<Boxes, Box<T>> $box): T {
  return $box->data;
}

function test0(): void {
  get(Boxes::Age); // ok, of type int, returns 42
  get(Boxes::Color); // ok, of type string, returns 'red'
  get(Boxes::Year); // ok, of type int, returns 2021
}
