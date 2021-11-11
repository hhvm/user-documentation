// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\AsynchronousOperations\Exceptions\MemoizedAsyncThrow;

<<__Memoize>>
async function throw_something(): Awaitable<int> {
  throw new \Exception();
}

async function foo(): Awaitable<void> {
  await throw_something();
}

async function bar(): Awaitable<void> {
  await throw_something();
}

<<__EntryPoint>>
async function main(): Awaitable<void> {
  \init_docs_autoloader();

  try {
    await foo();
  } catch (\Exception $e) {
    \var_dump($e->getTrace()[2] as shape('function' => string, ...)['function']);
  }
  try {
    await bar();
  } catch (\Exception $e) {
    \var_dump($e->getTrace()[2] as shape('function' => string, ...)['function']);
  }
}
