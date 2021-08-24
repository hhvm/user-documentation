// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\BuiltInTypes\EnumClass\EnumClassIntro;

// Enum class where we allow any type
enum class Random : mixed {
  int X = 42;
  string S = 'foo';
}

// Enum class that mimics a normal enum (only allowing ints)
enum class Ints : int {
  int A = 0;
  int B = 10;
}
