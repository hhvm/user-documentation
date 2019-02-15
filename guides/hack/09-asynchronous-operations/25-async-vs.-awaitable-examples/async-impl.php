<?hh // strict

namespace Hack\UserDocumentation\AsyncOps\AsyncVsAwaitables\Examples\Impl;

require_once "interface.php";

class Ford implements Car {
  public async function drive(): Awaitable<void> {
    // ...
  }
}
