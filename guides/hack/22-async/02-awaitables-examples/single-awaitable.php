<?hh

namespace Hack\UserDocumentation\Async\Awaitables\Examples\SingleAwaitable;

async function foo(): Awaitable<int> {
  return 3;
}

async function single_awaitable_main(): Awaitable<void> {
  $aw = foo(); // awaitable of type Awaitable<int>
  $result = await $aw; // an int after $aw completes
  \var_dump($result);
}

single_awaitable_main();
