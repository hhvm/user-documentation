// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\BuiltInTypes\EnumClass\EnumClassBox;

enum class DiamondBase: IBox {
  Box<int> Age = new Box(42);
}

enum class D1: IBox extends DiamondBase {
  Box<string> Name1 = new Box('foo');
}

enum class D2: IBox extends DiamondBase {
  Box<string> Name2 = new Box('bar');
}

enum class D3: IBox extends D1, D2 {}

<<__EntryPoint>>
function main(): void {
  \init_docs_autoloader();

  echo D3::Age->data;
}
