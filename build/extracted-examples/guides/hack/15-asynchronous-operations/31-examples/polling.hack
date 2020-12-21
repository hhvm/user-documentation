// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\AsynchronousOperations\Examples\Polling;

use namespace HH\Lib\Vec;

// Of course, this is all made up :)
class Polling {
  private int $count = 0;
  public function isReady(): bool {
    $this->count++;
    if ($this->count > 10) {
      return true;
    }
    return false;
  }
  public function getResult(): int {
    return 23;
  }
}

async function do_polling(Polling $p): Awaitable<int> {
  echo "do polling 1".\PHP_EOL;
  // No async function in Polling, so loop until we are ready, but let
  // other awaitables go via later()
  while (!$p->isReady()) {
    await \HH\Asio\later();
  }
  echo "\ndo polling 2".\PHP_EOL;
  return $p->getResult();
}

async function no_polling(): Awaitable<string> {
  echo '.';
  return \str_shuffle("ABCDEFGH");
}

async function polling_example(): Awaitable<void> {
  $handles = vec[do_polling(new Polling())];
  // To make this semi-realistic, call no_polling a bunch of times to show
  // that do_polling is waiting.
  for ($i = 0; $i < 50; $i++) {
    $handles[] = no_polling();
  }

  $results = await Vec\from_async($handles);
}

<<__EntryPoint>>
function main(): void {
  \init_docs_autoloader();

  \HH\Asio\join(polling_example());
}
