<?hh

namespace Hack\UserDocumentation\Async\Exceptions\Examples\MultipleAwaitable;

async function exception_thrower(): Awaitable<void> {
  throw new \Exception("Return exception handle");
}

async function non_exception_thrower(): Awaitable<int> {
  return 2;
}

async function multiple_waithandle_exception(): Awaitable<void> {
  $handles = [exception_thrower(), non_exception_thrower()];
  // You will get a fatal error here with the exception thrown
  $results = await \HH\Asio\v($handles);
  // This won't happen
  var_dump($results);
}

\HH\Asio\join(multiple_waithandle_exception());
