<?hh // strict

namespace Hack\UserDocumentation\AsyncOps\Guidelines\Examples\AsyncHello;

async function get_hello(): Awaitable<string> {
  return "Hello";
}

<<__Entrypoint>>
async function run_a_hello(): Awaitable<void> {
  $x = await get_hello();
  \var_dump($x);
}
