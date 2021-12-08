// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\Readonly\Syntax\ReadonlyExpressions;

<<file:__EnableUnstableFeatures("readonly")>>
class Foo {}
function foo(): void {
  $x = new Foo();
  $y = readonly $x;
}
