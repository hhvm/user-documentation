// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\Generics\TypeConstraints\MaxVal;

function max_val<T as num>(T $p1, T $p2): T {
  return $p1 > $p2 ? $p1 : $p2;
}

<<__EntryPoint>>
function main(): void {
  \init_docs_autoloader();

  echo "max_val(10, 20) = ".max_val(10, 20)."\n";
  echo "max_val(15.6, -20.78) = ".max_val(15.6, -20.78)."\n";
}
