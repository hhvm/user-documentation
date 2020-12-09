// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Api\Hack\ClassHHVectorMethodToSet\BasicUsage;

<<__EntryPoint>>
async function _main(): Awaitable<void> {
  \init_docs_autoloader();

  // This Vector contains repetitions of 'red' and 'blue'
  $v = Vector {'red', 'green', 'red', 'blue', 'red', 'yellow', 'blue'};

  $set = $v->toSet();

  \var_dump($set is \HH\Set<_>);
  \var_dump($set);
}
