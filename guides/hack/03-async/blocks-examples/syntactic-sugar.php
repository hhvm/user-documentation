<?hh

namespace Hack\UserDocumentation\Async\Blocks\Examples\SyntaticSugar;

async function gen_int(): Awaitable<int> {
  return 4;
}

async function gen_float(): Awaitable<float> {
  return 1.2;
}

async function gen_string(): Awaitable<string> {
  return "Hello";
}

async function gen_call<Tv>((function (): Awaitable<Tv>) $gen): Awaitable<Tv> {
  return await $gen();
}

async function use_async_lambda(): Awaitable<void> {
  // To use an async lambda with no arguments, you would to have a helper
  // function to return an actual Awaitable for you.
  $x = await gen_call(
    async () ==> {
      $y = await gen_float();
      $z = await gen_int();
      return round($y) + $z;
    }
  );
  var_dump($x);
}

async function use_async_block(): Awaitable<void> {
  // With an async block, no helper function needed. It is all built-in to the
  // async block itself.
  $x = await async {
    $y = await gen_float();
    $z = await gen_int();
    return round($y) + $z;
  };
  var_dump($x);
}

async function call_async_function(): Awaitable<void> {
  // Normally you have to call a simple async function and get its value, even
  // if it takes no arguments, etc.
  $x = await gen_string();
  var_dump($x);
}

async function use_async_block_2(): Awaitable<void> {
  // Here you can inline your function right in the async block
  $x = await async { return "Hello"; };
  var_dump($x);
}

\HH\Asio\join(use_async_lambda());
\HH\Asio\join(use_async_block());

\HH\Asio\join(call_async_function());
\HH\Asio\join(use_async_block_2());
