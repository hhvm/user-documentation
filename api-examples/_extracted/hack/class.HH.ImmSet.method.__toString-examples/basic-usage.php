<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ClassHHImmSetMethodToString\BasicUsage;

<<__EntryPoint>>
function _main(): void {
  \init_docs_autoloader();

  $is = ImmSet {1, 2, 3};
  echo $is->__toString()."\n";

  $is2 = ImmSet {'a', 'b', 'c'};
  echo $is2->__toString()."\n";

  $is3 = ImmSet {};
  echo $is3->__toString()."\n";
}
