// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\BuiltInTypes\EnumClassLabel\EnumClassLabelIntro;

enum E: int {
  A = 42;
  B = 42;
}

function f(E $value): void {
  switch($value) {
    case E::A: echo "A "; break;
    case E::B: echo "B "; break;
  }
  echo $value . "\n";
}
