<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ClassHHImmVectorMethodToString\BasicUsage;

<<__EntryPoint>>
function _main(): void {
  \init_docs_autoloader();

  $v = Vector {1, 2, 3};
  echo $v->__toString()."\n";

  $v2 = Vector {'a', 'b', 'c'};
  echo $v2->__toString()."\n";

  $v3 = Vector {};
  echo $v3->__toString()."\n";
}
