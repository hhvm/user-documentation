<?hh // strict

namespace HH\Asio;

// Replace calls to these with calls to HH\Asio\va() when that is implemented

async function va2<Ta,Tb>(
  Awaitable<Ta> $a,
  Awaitable<Tb> $b,
): Awaitable<(Ta, Tb)> {
  $list = await v(Vector{$a, $b});
  // UNSAFE
  return tuple($list[0], $list[1]);
}
