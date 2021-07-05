<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\BuiltInTypes\EnumClass\EnumClassBox;

enum class E : IBox {
  Box<int> Age = new Box(42);
}

enum class E1 : IBox extends E {
  Box<string> Name1 = new Box('foo');
}

enum class E2 : IBox extends E {
  Box<string> Name2 = new Box('bar');
}

enum class E3 : IBox extends E1, E2 {}

<<__EntryPoint>>
function main() : void {
  \init_docs_autoloader();

  echo E3::Age->data;
}
