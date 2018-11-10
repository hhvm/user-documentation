<?hh // strict

namespace Hack\UserDocumentation\AsyncOps\Examples\Examples\Join;

async function join_async(): Awaitable<string> {
  return "Hello";
}

// In an async function, you would await an awaitable.
// In a non-async function, or the global scope, you can
// use `join` to force the the awaitable to run to its completion.

<<__Entrypoint>>
function main(): void {
  $s = \HH\Asio\join(join_async());
  \var_dump($s);
}
