<?hh

namespace Hack\UserDocumentation\Examples\AsyncDisposables\Simple;

class Handle implements \IAsyncDisposable {
  public async function __disposeAsync(): Awaitable<void> {
    print("Disposing\n");
  }
}

async function main(): Awaitable<void> {
  print("doing stuff\n");
  await using new Handle();
  print("doing more stuff\n");
}

main();
