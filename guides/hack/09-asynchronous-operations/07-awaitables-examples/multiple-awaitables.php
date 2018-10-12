<?hh // strict

namespace Hack\UserDocumentation\AsyncOps\Awaitables\Examples\MultipleAwaitables;

async function quads(float $n): Awaitable<float> {
  return $n * 4.0;
}

<<__Entrypoint>>
async function quads_m(): Awaitable<void> {
  $awaitables = dict['five' => quads(5.0), 'nine' => quads(9.0)];
  $results = await \HH\Lib\Dict\from_async($awaitables);

  \var_dump($results['five']); // float(20)
  \var_dump($results['nine']); // float(36)
}
