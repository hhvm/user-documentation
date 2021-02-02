// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\BuiltInTypes\EnumClass\EnumClassBox;

enum class E : IBox {
  Box<int> Age = new Box(42);
}

enum class F : IBox {
  Box<int> Age = new Box(42);
}

enum class X : IBox extends E, F { } // ok, no ambiguity


enum class E0 : IBox extends E {
  Box<string> Name = new Box('foo');
}

enum class E1 : IBox extends E {
  Box<string> Color = new Box('red');
}

// type error, Y::Age is declared twice, in E0 and in E1
enum class Y : IBox extends E0, E1 { }
