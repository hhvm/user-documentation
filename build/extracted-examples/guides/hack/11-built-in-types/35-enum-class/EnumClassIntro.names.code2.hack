// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\BuiltInTypes\EnumClass\EnumClassIntro;

function show_name_from_names(\HH\MemberOf<Names, IHasName> $x): string {
  echo "Showing names from the enum class `Names` only";
  return $x->name(); // HH\MemberOf is transparent to the runtime
}

function test2(): void {
  show_name(new HasName('toto')); // error, this instance is not from the Names enum
  show_name(Names::World); // no problem
}

enum class OtherNames: IHasName {
  HasName Foo = new HasName('foo');
}

function test3(): void {
  show_name(OtherNames::Foo); // error, expected Names but got OtherNames
}
