// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\BuiltInTypes\EnumClassLabel\EnumClassLabel;

function full_print(\HH\EnumClass\Label<E, int> $label): void {
  echo E::nameOf($label) . " ";
  echo E::valueOf($label) . "\n";
}

function partial_print(\HH\MemberOf<E, int> $value): void {
  echo $value . "\n";
}
