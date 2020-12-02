<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ClassHHVectorMethodToString\BasicUsage;

<<__EntryPoint>>
function _main(): void {
  \init_docs_autoloader();

  $iv = ImmVector {1, 2, 3};
  echo $iv->__toString()."\n";

  $iv2 = ImmVector {'a', 'b', 'c'};
  echo $iv2->__toString()."\n";

  $iv3 = ImmVector {};
  echo $iv3->__toString()."\n";
}
