// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\Attributes\PredefinedAttributes\NewableComplete;

<<__ConsistentConstruct>>
abstract class A {
  public function __construct(int $x, int $y) {}
}

class B extends A {}

function f<<<__Newable>> reify T as A>(int $x, int $y): T {
  return new T($x,$y);
}

<<__EntryPoint>>
function main(): void {
  \init_docs_autoloader();

  f<B>(3,4);             // success, equivalent to new B(3,4)
}
