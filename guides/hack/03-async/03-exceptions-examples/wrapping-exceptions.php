<?hh

namespace Hack\UserDocumentation\Async\Exceptions\Examples\Wrapping;

require __DIR__ . "/../../../../vendor/autoload.php";

async function exception_thrower(): Awaitable<void> {
  throw new \Exception();
}

async function non_exception_thrower(): Awaitable<int> {
  return 2;
}

async function wrapping_exceptions(): Awaitable<void> {
  $handles = [\HH\Asio\wrap(exception_thrower()),
              \HH\Asio\wrap(non_exception_thrower())];
  // Since we wrapped, the results will contain both the exception and the
  // integer result
  $results = await \HH\Asio\v($handles);
  var_dump($results);
}

\HH\Asio\join(wrapping_exceptions());
