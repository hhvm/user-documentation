// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\BuiltInTypes\EnumClassLabel\EnumClassLabel;

class Foo {}

enum class F: Foo {
  Foo A = new Foo();
}

// E#A === E#B is false
// E#A === F#A is true
