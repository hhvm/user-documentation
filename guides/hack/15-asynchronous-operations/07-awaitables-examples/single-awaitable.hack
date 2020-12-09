// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\AsynchronousOperations\Awaitables\SingleAwaitable;

async function foo(): Awaitable<int> {
  return 3;
}

<<__EntryPoint>>
async function single_awaitable_main(): Awaitable<void> {
  \init_docs_autoloader();

  $aw = foo(); // awaitable of type Awaitable<int>
  $result = await $aw; // an int after $aw completes
  \var_dump($result);
}
