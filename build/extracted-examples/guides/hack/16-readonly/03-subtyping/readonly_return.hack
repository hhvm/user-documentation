// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\Readonly\Subtyping\ReadonlyReturn;

class Foo {}
function returns_mutable(readonly Foo $x): Foo {
  return $x; // error, $x is readonly
}
