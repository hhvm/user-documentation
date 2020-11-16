<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\AsynchronousOperations\Exceptions\MultipleAwaitableException;

use namespace HH\Lib\Vec;

async function exception_thrower(): Awaitable<void> {
  throw new \Exception("Return exception handle");
}

async function non_exception_thrower(): Awaitable<int> {
  return 2;
}

async function multiple_waithandle_exception(): Awaitable<void> {
  $handles = vec[exception_thrower(), non_exception_thrower()];
  // You will get a fatal error here with the exception thrown
  $results = await Vec\from_async($handles);
  // This won't happen
  \var_dump($results);
}

<<__EntryPoint>>
function main(): void {
  \init_docs_autoloader();

  \HH\Asio\join(multiple_waithandle_exception());
}
