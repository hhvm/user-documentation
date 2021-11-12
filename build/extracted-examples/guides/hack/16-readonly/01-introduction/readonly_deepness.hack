// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\Readonly\Introduction\ReadonlyDeepness;

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
function test(readonly Bar $x) : void {
  $foo = $x->foo;
  $foo->prop = 3; // error, $foo is readonly
}
