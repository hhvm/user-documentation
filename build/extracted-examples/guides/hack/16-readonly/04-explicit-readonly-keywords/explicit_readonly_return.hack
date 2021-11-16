// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\Readonly\ExplicitReadonlyKeywords\ExplicitReadonlyReturn;

<<file:__EnableUnstableFeatures("readonly")>>

class Foo {}
function returns_readonly(): readonly Foo {
  return readonly new Foo();
}

function test(): void {
  $x = readonly returns_readonly(); // this is required to call returns_readonly()
}
