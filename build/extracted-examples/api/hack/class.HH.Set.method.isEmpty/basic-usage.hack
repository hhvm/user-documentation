// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Api\Hack\ClassHHSetMethodIsEmpty\BasicUsage;

<<__EntryPoint>>
async function _main(): Awaitable<void> {
  \init_docs_autoloader();

  $s = Set {};
  \var_dump($s->isEmpty());

  $s = Set {'red', 'green', 'blue', 'yellow'};
  \var_dump($s->isEmpty());
}
