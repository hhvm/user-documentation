// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\BuiltInTypes\EnumeratedTypes\EnumSupertyping;

enum E1: int as int {
  A = 0;
}
enum E2: int as int {
  B = 1;
}
enum F: int {
  use E1;
  use E2;
  C = 2;
}
