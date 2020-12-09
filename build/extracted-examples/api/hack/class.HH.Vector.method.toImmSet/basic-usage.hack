// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Api\Hack\ClassHHVectorMethodToImmSet\BasicUsage;

<<__EntryPoint>>
async function _main(): Awaitable<void> {
  \init_docs_autoloader();

  // This Vector contains repetitions of 'red' and 'blue'
  $v = Vector {'red', 'green', 'red', 'blue', 'red', 'yellow', 'blue'};

  $imm_set = $v->toImmSet();

  \var_dump($imm_set is \HH\ImmSet<_>);
  \var_dump($imm_set);
}
