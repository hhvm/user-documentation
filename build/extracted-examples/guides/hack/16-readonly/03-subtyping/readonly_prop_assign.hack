// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\Readonly\Subtyping\ReadonlyPropAssign;

class Bar {}
class Foo {
  public function __construct(
    public readonly Bar $ro_prop,
    public Bar $mut_prop
  ){}
}

function test(
  Foo $x,
  readonly Bar $bar,
) : void {
  $x->mut_prop = $bar; // error, $bar is readonly but the prop is mutable
  $x->ro_prop = $bar; // ok
}
