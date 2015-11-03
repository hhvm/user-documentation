<?hh

namespace Hack\UserDocumentation\Async\Extensions\Examples\Stream;

function get_resources(): array<resource> {
  $r1 = fopen('php://stdout', 'w');
  $r2 = fopen('php://stdout', 'w');
  $r3 = fopen('php://stdout', 'w');

  return array($r1, $r2, $r3);
}

async function write_all(array<resource> $resources): Awaitable<void> {
  $write_single_resource = async function(resource $r) {
    $status = await stream_await($r, STREAM_AWAIT_WRITE, 1.0);
    if ($status === STREAM_AWAIT_READY) {
      fwrite($r, str_shuffle('ABCDEF') . PHP_EOL);
    }
  };
  // You will get 3 shuffled strings, each on a separate line.
  await \HH\Asio\v(array_map($write_single_resource, $resources));
}

\HH\Asio\join(write_all(get_resources()));
