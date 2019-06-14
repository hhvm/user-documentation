<?hh // strict

namespace Hack\UserDocumentation\AsyncOps\AsyncVsAwaitables\Examples\Impl;

require_once "interface.inc.php";

class Ford implements Car {
  public async function drive(): Awaitable<void> {
    // ...
  }
}
