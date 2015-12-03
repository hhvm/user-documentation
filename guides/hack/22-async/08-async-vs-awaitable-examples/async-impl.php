<?hh

namespace HHVM\UserDocumentation\Async\Examples\AsyncVsAwaitables;

class Ford implements Car {
  public async function drive(): Awaitable<void> {
    // ...
  }
}
