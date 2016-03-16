<?hh

namespace Hack\UserDocumentation\Async\Awaitables\Examples\AwaitableReturn;

async function f(): Awaitable<int> {
  return 2;
}

// You call f() and get back an Awaitable<int>
// Once the function is finish executing and you await the awaitable (or in
// this case explicitly join since this call is not in an async function) to get
// the explicit result of the function call, you will get back 2.
var_dump(\HH\Asio\join(f()));
