// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\SourceCodeFundamentals\Literals\DqVariableSubstitution;

class C {
  public int $p1 = 2;
}

<<__EntryPoint>>
function main(): void {
  \init_docs_autoloader();

  $x = 123;
  echo ">\$x.$x"."<\n";

  $myC = new C();
  echo "\$myC->p1 = >$myC->p1<\n";
}
