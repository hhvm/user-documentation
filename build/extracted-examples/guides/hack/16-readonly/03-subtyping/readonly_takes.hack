// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\Readonly\Subtyping\ReadonlyTakes;

class Foo {}
// promises not to modify $x
function takes_readonly(readonly Foo $x): void {
}

function test(): void {
    $z = new Foo();
    takes_readonly($z); // ok
}
