// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\Statements\Continue\OddValues;

<<__EntryPoint>>
async function _main(): Awaitable<void> {
  \init_docs_autoloader();

  for ($i = 1; $i <= 10; ++$i) {
    if (($i % 2) === 0)
      continue;
    echo "$i is odd\n";
  }
}
