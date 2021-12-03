// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\BuiltInTypes\Enum\EnumSupertyping;

enum E1: int as int {
  A = 0;
}
enum E2: int as int {
  B = 1;
}
enum F: int {
  // same-line alternative: use E1, E2;
  use E1;
  use E2;
  C = 2;
}
