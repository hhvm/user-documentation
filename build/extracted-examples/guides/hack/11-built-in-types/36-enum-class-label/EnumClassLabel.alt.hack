// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\BuiltInTypes\EnumClassLabel\EnumClassLabel;

function set<T>(\HH\EnumClass\Label<E, T> $label, T $data) : void {
  // setting $data into some storage using $label as a key
}

// all these calls are equivalent
function all_the_same(): void {
  set(E#A, 42);
  set(#A, 42);
  set#A(42);
}
