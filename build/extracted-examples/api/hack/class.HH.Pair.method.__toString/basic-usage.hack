// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Api\Hack\ClassHHPairMethodToString\BasicUsage;

<<__EntryPoint>>
async function _main(): Awaitable<void> {
  \init_docs_autoloader();

  $p = Pair {-1, 5};
  echo $p->__toString()."\n";

  $p2 = Pair {'foo', 'bar'};
  echo $p2->__toString()."\n";
}
