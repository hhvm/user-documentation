<?hh

namespace Hack\UserDocumentation\Async\WaitHandles\Examples\WaitHandleReturn;

async function f(): Awaitable<int> {
  // You aren't really returning 2 in the normal sense.
  // You are returning a wait handle that will, upon conclusion of execution,
  // contain the result of 2.
  return 2;
}
