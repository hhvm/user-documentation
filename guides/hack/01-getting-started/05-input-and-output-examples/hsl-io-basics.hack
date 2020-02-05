// @example-start Don't strip boilerplate since this is an introductory example.
namespace Hack\GettingStarted\HSLIO;

use namespace HH\Lib\Experimental\{File, IO};

<<__EntryPoint>>
async function main_async(): Awaitable<void> {
  // STDIN for CLI, or HTTP POST data
  $_in = IO\request_input();
  // STDOUT for CLI, or HTTP response
  $out = IO\request_output();

  $message = "Hello, world\n";
  await $out->writeAsync($message);

  // copy to a temporary file, automatically closed at scope exit
  await using ($f = File\temporary_file()) {
    await $f->writeAsync($message);

    await $f->seekAsync(0);
    $content = await $f->readAsync();
    await $out->writeAsync($content);
  }
}
