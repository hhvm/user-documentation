<?hh

namespace Hack\UserDocumentation\Async\Guidelines\Examples\Join;

async function join_async(): Awaitable<string> {
  return "Hello";
}

// In an async function, you would await an awaitable.
// In a non-async function, or the global scope, you can
// use `join` to force the the awaitable to run to its completion.
$s = \HH\Asio\join(join_async());
var_dump($s);
