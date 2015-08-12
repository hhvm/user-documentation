<?hh

namespace Hack\UserDocumentation\Async\WaitHandles\Examples\MultipleWaitHandles;

async function quads(float $n): Awaitable<float> {
  return $n * 4.0;
}

async function quads_m(): Awaitable<void> {
  $wait_handles = array(
    'five' => quads(5.0),
    'nine' => quads(9.0),
  );
  $results = await \HH\Asio\m($wait_handles);

  var_dump($results['five']); // float(20)
  var_dump($results['nine']); // float(36)
}

quads_m();
