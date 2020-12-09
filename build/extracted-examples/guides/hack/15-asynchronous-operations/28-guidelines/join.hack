// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\AsynchronousOperations\Guidelines\Join;

async function join_async(): Awaitable<string> {
  return "Hello";
}

// In an async function, you would await an awaitable.
// In a non-async function, or the global scope, you can
// use `join` to force the the awaitable to run to its completion.

<<__EntryPoint>>
function main(): void {
  \init_docs_autoloader();

  $s = \HH\Asio\join(join_async());
  \var_dump($s);
}
