<?hh // partial

namespace Hack\UserDocumentation\AsyncOps\Basics\Examples\Limitations;
use namespace HH\Lib\Vec;

async function do_cpu_work(): Awaitable<void> {
  print("Start CPU work\n");
  $a = 0;
  $b = 1;

  $list = vec[$a, $b];

  for ($i = 0; $i < 1000; ++$i) {
    $c = $a + $b;
    $list[] = $c;
    $a = $b;
    $b = $c;
  }
  print("End CPU work\n");
}

async function do_sleep(): Awaitable<void> {
  print("Start sleep\n");
  \sleep(1);
  print("End sleep\n");
}

async function run(): Awaitable<void> {
  print("Start of main()\n");
  await Vec\from_async(vec[do_cpu_work(), do_sleep()]);
  print("End of main()\n");
}

<<__EntryPoint>>
function main(): void {
  \init_docs_autoloader();
  \HH\Asio\join(run());
}
