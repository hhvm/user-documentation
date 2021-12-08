// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\Readonly\Syntax\ReadonlyParameters;

<<file:__EnableUnstableFeatures("readonly")>>
class Bar {
  public function __construct(
    public Foo $foo,
  ){}
}
class Foo {
  public function __construct(
    public int $prop,
  ) {}
}

function getFoo(readonly Bar $x): readonly Foo {
  return $x->foo;
}
