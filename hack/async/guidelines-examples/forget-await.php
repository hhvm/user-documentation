<?hh

async function speak(): Awaitable<void> {
  echo "one";
  await HH\Asio\later();
  echo "two";
  echo "three";
}

async function forget_await(): Awaitable<void> {
  $handle = speak(); // This just gets you the handle
}

forget_await();
