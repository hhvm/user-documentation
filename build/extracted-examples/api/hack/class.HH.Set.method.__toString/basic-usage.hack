// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Api\Hack\ClassHHSetMethodToString\BasicUsage;

<<__EntryPoint>>
async function _main(): Awaitable<void> {
  \init_docs_autoloader();

  $s = Set {1, 2, 3};
  echo $s->__toString()."\n";

  $s2 = Set {'a', 'b', 'c'};
  echo $s2->__toString()."\n";

  $s3 = Set {};
  echo $s3->__toString()."\n";
}
