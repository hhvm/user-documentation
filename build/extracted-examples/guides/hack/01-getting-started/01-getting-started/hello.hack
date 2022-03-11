// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\GettingStarted\GettingStarted\Hello;

use namespace HH\Lib\IO;

<<__EntryPoint>>
async function main(): Awaitable<void> {
  \init_docs_autoloader();

  await IO\request_output()->writeAllAsync("Hello World!\n");
}
