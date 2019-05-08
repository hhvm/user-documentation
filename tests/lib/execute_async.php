<?hh // strict

namespace HHVM\UserDocumentation\Tests;

use namespace HH\Lib\{Str, Vec};

// A wrapper around the built-in exec with a nicer signature.
async function execute_async(string ...$args): Awaitable<(int, string, string)> {
	$command = $args
		|> Vec\map($$, $arg ==> \escapeshellarg($arg))
		|> Str\join($$, ' ');

	$spec = [0 => ['pipe', 'r'], 1 => ['pipe', 'w'], 2 => ['pipe', 'w']];
	$pipes = [];

	$proc = \proc_open($command, $spec, &$pipes);

	list($stdin, $stdout, $stderr) = $pipes;
	\fclose($stdin);
	\stream_set_blocking($stdout, false);

	$exit_code = -2;
	$output = '';
	while (true) {
		/* HHAST_IGNORE_ERROR[DontAwaitInALoop] */
		$chunk = \stream_get_contents($stdout);
		$output .= $chunk;
		$status = \proc_get_status($proc);
		if ($status['pid'] && !$status['running']) {
			$exit_code = $status['exitcode'];
			break;
		}
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
