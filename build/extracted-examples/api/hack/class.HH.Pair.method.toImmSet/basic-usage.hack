// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Api\Hack\ClassHHPairMethodToImmSet\BasicUsage;

<<__EntryPoint>>
async function _main(): Awaitable<void> {
  \init_docs_autoloader();

  // This Pair contains 'foo' twice
  $p = Pair {'foo', 'foo'};

  $imm_set = $p->toImmSet();
  \var_dump($imm_set);
}
