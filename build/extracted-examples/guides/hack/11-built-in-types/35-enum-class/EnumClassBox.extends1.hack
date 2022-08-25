// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\BuiltInTypes\EnumClass\EnumClassBox;

enum class E: IBox {
  Box<int> Age = new Box(42);
}

enum class F: IBox {
  Box<string> Name = new Box('foo');
}

enum class X: IBox extends E, F { } // ok, no ambiguity


enum class E0: IBox extends E {
  Box<int> Color = new Box(0);
}

enum class E1: IBox extends E {
  Box<string> Color = new Box('red');
}

// enum class Y: IBox extends E0, E1 { }
// type error, Y::Color is declared twice, in E0 and in E1
// only he name is use for ambiguity
