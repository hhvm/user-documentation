// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\Readonly\ExplicitReadonlyKeywords\ExplicitReadonlyProp;

<<file:__EnableUnstableFeatures("readonly")>>

class Bar {}
class Foo {
  public function __construct(
    public readonly Bar $bar,
  ) {}
}

function test(Foo $f): void {
  $bar = readonly $f->bar; // this is required
}
