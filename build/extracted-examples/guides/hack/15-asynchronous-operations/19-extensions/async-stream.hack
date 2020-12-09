// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\AsynchronousOperations\Extensions\AsyncStream;

use namespace HH\Lib\Vec;

function get_resources(): vec<resource> {
  $r1 = \fopen('php://stdout', 'w');
  $r2 = \fopen('php://stdout', 'w');
  $r3 = \fopen('php://stdout', 'w');

  return vec[$r1, $r2, $r3];
}

async function write_all(vec<resource> $resources): Awaitable<void> {
  $write_single_resource = async function(resource $r) {
    $status = await \stream_await($r, \STREAM_AWAIT_WRITE, 1.0);
    if ($status === \STREAM_AWAIT_READY) {
      \fwrite($r, \str_shuffle('ABCDEF').\PHP_EOL);
    }
  };
  // You will get 3 shuffled strings, each on a separate line.
  await Vec\from_async(\array_map($write_single_resource, $resources));
}

<<__EntryPoint>>
function main(): void {
  \init_docs_autoloader();

  \HH\Asio\join(write_all(get_resources()));
}
