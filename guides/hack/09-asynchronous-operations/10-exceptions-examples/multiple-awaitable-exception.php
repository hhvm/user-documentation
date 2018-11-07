<?hh // strict

namespace Hack\UserDocumentation\AsyncOps\Exceptions\Examples\MultipleAwaitable;
use namespace HH\Lib\Vec;

async function exception_thrower(): Awaitable<void> {
  throw new \Exception("Return exception handle");
}

async function non_exception_thrower(): Awaitable<int> {
  return 2;
}

async function multiple_waithandle_exception(): Awaitable<void> {
  $handles = vec[exception_thrower(), non_exception_thrower()];
  try {
    $results = await Vec\from_async($handles);
    \var_dump($results);
  }
  catch (\Exception $e) {
  	// ...
  }
}

<<__Entrypoint>>
function main(): void {
  \HH\Asio\join(multiple_waithandle_exception());
}

