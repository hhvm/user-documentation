<?hh

namespace Hack\UserDocumentation\Async\Guidelines\Examples\Hello;

async function get_hello(): Awaitable<string> {
  return "Hello";
}

async function run_a_hello(): Awaitable<void> {
  $x = await get_hello();
  \var_dump($x);
}

run_a_hello();
