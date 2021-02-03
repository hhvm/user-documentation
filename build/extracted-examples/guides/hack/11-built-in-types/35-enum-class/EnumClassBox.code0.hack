// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\BuiltInTypes\EnumClass\EnumClassBox;

function get_int(\HH\MemberOf<Boxes, Box<int>> $box) : int {
  return $box->data;
}

function test1(): void {
  get_int(Boxes::Age); // ok
  // get_int(Boxes::Color); // type error, Color is not a Box<int>
}
