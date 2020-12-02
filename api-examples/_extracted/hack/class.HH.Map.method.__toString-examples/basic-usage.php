<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ClassHHMapMethodToString\BasicUsage;

<<__EntryPoint>>
function _main(): void {
  \init_docs_autoloader();

  $m = Map {'a' => 1, 'b' => 2, 'c' => 3};
  echo $m->__toString()."\n";

  $m3 = Map {};
  echo $m3->__toString()."\n";
}
