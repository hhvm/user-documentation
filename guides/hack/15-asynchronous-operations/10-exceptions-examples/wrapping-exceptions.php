<?hh // strict

namespace Hack\UserDocumentation\AsyncOps\Exceptions\Examples\Wrapping;
use namespace HH\Lib\Vec;

async function exception_thrower(): Awaitable<void> {
  throw new \Exception();
}

async function non_exception_thrower(): Awaitable<int> {
  return 2;
}

async function wrapping_exceptions(): Awaitable<void> {
  $handles = vec[
    \HH\Asio\wrap(exception_thrower()),
    \HH\Asio\wrap(non_exception_thrower()),
  ];
  // Since we wrapped, the results will contain both the exception and the
  // integer result
  $results = await Vec\from_async($handles);
  \var_dump($results);
}

<<__EntryPoint>>
function main(): void {
  \__init_autoload();
  \HH\Asio\join(wrapping_exceptions());
}
