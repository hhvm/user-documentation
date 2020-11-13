<?hh

namespace Hack\UserDocumentation\AsyncOps\Awaitables\Examples\AwaitableReturn;

async function f(): Awaitable<int> {
  return 2;
}

// We call f() and get back an Awaitable<int>
// Once the function is finished executing and we await the awaitable (or in
// this case, explicitly join since this call is not in an async function) to get
// the explicit result of the function call, we will get back 2.

<<__EntryPoint>>
function join_main(): void {
  \var_dump(\HH\Asio\join(f()));
}
