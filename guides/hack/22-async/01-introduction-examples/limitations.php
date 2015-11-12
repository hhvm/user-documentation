<?hh

namespace Hack\UserDocumentation\Async\Intro\Examples\Limtations;

async function do_cpu_work(): Awaitable<void> {
  print("Start CPU work\n");
  $a = 0;
  $b = 1;

  $list = [$a, $b];
 
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
  sleep(1);
  print("End sleep\n");
}

async function main(): Awaitable<void> {
  print("Start of main()\n");
  await \HH\Asio\v([
    do_cpu_work(),
    do_sleep(),
 ]);
  print("End of main()\n");
}

\HH\Asio\join(main());
