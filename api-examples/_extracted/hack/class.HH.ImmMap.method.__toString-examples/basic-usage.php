<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ClassHHImmMapMethodToString\BasicUsage;

<<__EntryPoint>>
function _main(): void {
  \init_docs_autoloader();

  $im = ImmMap {'a' => 1, 'b' => 2, 'c' => 3};
  echo $im->__toString()."\n";

  $im3 = ImmMap {};
  echo $im3->__toString()."\n";
}
