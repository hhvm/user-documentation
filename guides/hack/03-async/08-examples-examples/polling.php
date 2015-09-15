<?hh

namespace Hack\UserDocumentation\Async\Examples\Examples\Polling;

// For asio-utilities function later(), etc.
require __DIR__ . "/../../../vendor/autoload.php";

// Of course, this is all made up :)
class Polling {
  public function isReady(): bool {
    if (rand(0, 25) === 23) {
      return true;
    }
    return false;
  }
  public function getResult(): int {
    return 23;
  }
}

async function do_polling(Polling $p): Awaitable<int> {
  echo "do polling 1" . PHP_EOL;
  // No async function in Polling, so loop until we are ready, but let
  // other awaitables go via later()
  while (!$p->isReady()) {
    await \HH\Asio\later();
  }
  echo "do polling 2" . PHP_EOL;
  return $p->getResult();
}

async function no_polling(): Awaitable<string> {
  echo "no polling" . PHP_EOL;
  return str_shuffle("ABCDEFGH");
}

async function polling_example(): Awaitable<void> {
  $handles = array(do_polling(new Polling()));
  // To make this semi-realistic, call no_polling a bunch of times to show
  // that do_polling is waiting.
  for ($i = 0; $i < 50; $i++) {
    $handles[] = no_polling();
  }

  $results = await \HH\Asio\v($handles);
}

\HH\Asio\join(polling_example());
