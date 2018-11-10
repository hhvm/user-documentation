<?hh // strict

namespace Hack\UserDocumentation\AsyncOps\Examples\Examples\Basic;

// async specifies a function will return an awaitable. Awaitable<string> means
// that the awaitable will ultimately return a string when complete
async function trivial(): Awaitable<string> {
  return "Hello";
}

<<__Entrypoint>>
async function call_trivial(): Awaitable<void> {
  // These first two lines could be combined into
  //     $result = await trivial();
  // but wanted to show the process

  // get awaitable that you can wait for completion
  $aw = trivial();
  // wait for the operation to complete and get the result
  $result = await $aw;
  echo $result; // "Hello"
}

