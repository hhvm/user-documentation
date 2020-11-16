<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\AsynchronousOperations\Guidelines\AsyncHello;

async function get_hello(): Awaitable<string> {
  return "Hello";
}

<<__EntryPoint>>
async function run_a_hello(): Awaitable<void> {
  \init_docs_autoloader();

  $x = await get_hello();
  \var_dump($x);
}
