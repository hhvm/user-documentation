<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\AsynchronousOperations\Exceptions\BasicException;

async function exception_thrower(): Awaitable<void> {
  throw new \Exception("Return exception handle");
}

async function basic_exception(): Awaitable<void> {
  // the handle does not throw, but result will be an Exception objection.
  // Remember, this is the same as:
  //   $handle = exception_thrower();
  //   await $handle;
  await exception_thrower();
}

<<__EntryPoint>>
function main(): void {
  \init_docs_autoloader();

  \HH\Asio\join(basic_exception());
}
