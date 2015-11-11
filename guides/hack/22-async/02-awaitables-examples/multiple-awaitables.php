<?hh

namespace Hack\UserDocumentation\Async\Awaitables\Examples\MultipleAwaitables;

async function quads(float $n): Awaitable<float> {
  return $n * 4.0;
}

async function quads_m(): Awaitable<void> {
  $awaitables = array(
    'five' => quads(5.0),
    'nine' => quads(9.0),
  );
  $results = await \HH\Asio\m($awaitables);

  var_dump($results['five']); // float(20)
  var_dump($results['nine']); // float(36)
}

quads_m();
