<?hh

async function join_async(): Awaitable<string> {
  return "Hello";
}

$s = HH\Asio\join(join_async());
var_dump($s);
