// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\Readonly\ExplicitReadonlyKeywords\ReadonlyCoeffects;

<<file:__EnableUnstableFeatures("readonly")>> 
class Bar {}
class Foo {
  public static readonly ?Bar $bar = null;
}

function read_static()[read_globals]: void {
  $y = readonly Foo::$bar; // keyword required
}
function read_static2()[leak_safe]: void {
  $y = readonly Foo::$bar; // keyword required
}
