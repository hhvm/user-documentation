<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ClassHHSetMethodToString\BasicUsage;

<<__EntryPoint>>
function _main(): void {
  \init_docs_autoloader();

  $s = Set {1, 2, 3};
  echo $s->__toString()."\n";

  $s2 = Set {'a', 'b', 'c'};
  echo $s2->__toString()."\n";

  $s3 = Set {};
  echo $s3->__toString()."\n";
}
