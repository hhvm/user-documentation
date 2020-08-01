<?hh // strict

namespace Hack\UserDocumentation\AsyncOps\AsyncVsAwaitables\Examples\AsyncImpl;

interface Car {
  public function drive(): Awaitable<void>;
}

// @example-start
class Ford implements Car {
  public async function drive(): Awaitable<void> {
    // ...
  }
}
