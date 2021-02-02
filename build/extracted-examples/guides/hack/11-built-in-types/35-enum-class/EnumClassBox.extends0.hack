// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\BuiltInTypes\EnumClass\EnumClassBox;

enum class EBase : IBox {
  Box<int> Age = new Box(42);
}

enum class EExtend : IBox extends EBase {
  Box<int> Color = new Box('red');
}
