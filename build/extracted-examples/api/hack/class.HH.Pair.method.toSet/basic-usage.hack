// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Api\Hack\ClassHHPairMethodToSet\BasicUsage;

<<__EntryPoint>>
async function _main(): Awaitable<void> {
  \init_docs_autoloader();

  // This Pair contains 'foo' twice
  $p = Pair {'foo', 'foo'};

  $s = $p->toSet();
  \var_dump($s);
}
