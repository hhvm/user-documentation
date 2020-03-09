<?hh // strict

namespace HHVM\UserDocumentation\_Private;

use namespace HH\Lib\{Str, Vec};

type SubprocessOptions = shape(
  ?'working_directory' => string,
  ?'environment' => dict<string, string>,
);

// A wrapper around the built-in exec with a nicer signature.
async function execute_async(
  ?SubprocessOptions $options,
  string ...$args
): Awaitable<(int, string, string)> {
  $command = $args
    |> Vec\map($$, $arg ==> \escapeshellarg($arg))
    |> Str\join($$, ' ');

  $spec = darray[
    0 => varray['pipe', 'r'],
    1 => varray['pipe', 'w'],
    2 => varray['pipe', 'w'],
  ];
  $pipes = varray[];

  $proc = \proc_open(
    $command,
    $spec,
    inout $pipes,
    $options['working_directory'] ?? null,
    $options['environment'] ?? null,
  );

  list($stdin, $stdout, $stderr) = $pipes;
  \fclose($stdin);
  \stream_set_blocking($stdout, false);

  $exit_code = -2;
  $output = '';
  while (true) {
    $chunk = \stream_get_contents($stdout);
    $output .= $chunk;
    $status = \proc_get_status($proc);
    if ($status['pid'] && !$status['running']) {
      $exit_code = $status['exitcode'];
      break;
    }
    /* HHAST_IGNORE_ERROR[DontAwaitInALoop] */
    await \stream_await($stdout, \STREAM_AWAIT_READ | \STREAM_AWAIT_ERROR);
  }
  $output .= \stream_get_contents($stdout);
  $error_output = \stream_get_contents($stderr);
  \fclose($stdout);
  \fclose($stderr);

  // Always returns -1 if we called `proc_get_status` first
  \proc_close($proc);

  return tuple($exit_code, $output, $error_output);
}
