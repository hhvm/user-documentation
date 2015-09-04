<?hh

namespace Hack\UserDocumentation\Async\Guidelines\Examples\ForgetAwait;

require __DIR__ . "/../../../vendor/autoload.php";

async function speak(): Awaitable<void> {
  echo "one";
  await \HH\Asio\later();
  echo "two";
  echo "three";
}

async function forget_await(): Awaitable<void> {
  $handle = speak(); // This just gets you the handle
}

forget_await();
