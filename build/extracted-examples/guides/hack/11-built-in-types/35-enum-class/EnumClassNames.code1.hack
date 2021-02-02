// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\BuiltInTypes\EnumClass\EnumClassNames;

function show_name_interface(IHasName $x) : string {
  return $x->name();
}

function show_name(HasName $x) : string {
  return $x->name();
}

function test1(): void {
  show_name(new HasName('toto')); // Ok
  show_name_interface(Names::Bar); // Ok
  show_name(Names::Hello); // Ok
  show_name(new ConstName()); // error, ConstName is not a subtype of HasName
  show_name(Names::Bar); // error, ConstName is not a subtype of HasName
}
