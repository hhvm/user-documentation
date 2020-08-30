<?hh

namespace Hack\UserDocumentation\Types\Nothing\Examples\Undefined;

interface Amazing {
  public function isAmazed(Trick $trick): bool;
}

final class Trick {
  public function __construct(private string $name) {}
  public async function fetchAsync(): Awaitable<string> {
    return 'some api response ;)';
  }
}

function amazing_trick(Amazing $subject, Trick ...$tricks): ?Trick {
  foreach ($tricks as $trick) {
    if ($subject->isAmazed($trick)) {
      return $trick;
    }
  }
  return null;
}

<<__EntryPoint>>
async function main_async(): Awaitable<void> {
  \init_docs_autoloader();
  $amazing_trick = amazing_trick(
    undefined(),
    new Trick('async'),
    new Trick('the `?->` operator'),
    new Trick('undefined'),
  );

  // We won't ever reach this line, since `undefined()` will halt the program by throwing.
  // However, we can continue writing our business logic and come back to this later.
  echo await $amazing_trick?->fetchAsync();
}
