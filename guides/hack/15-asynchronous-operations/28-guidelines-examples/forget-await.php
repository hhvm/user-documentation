<?hh // strict

namespace Hack\UserDocumentation\AsyncOps\Guidelines\Examples\ForgetAwait;

require __DIR__."/../../../../vendor/hh_autoload.php";

async function speak(): Awaitable<void> {
  echo "one";
  await \HH\Asio\later();
  echo "two";
  echo "three";
}

<<__EntryPoint>>
async function forget_await(): Awaitable<void> {
  $handle = speak(); // This just gets you the handle
}
