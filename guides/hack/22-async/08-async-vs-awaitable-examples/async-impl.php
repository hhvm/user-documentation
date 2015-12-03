<?hh

namespace HHVM\UserDocumentation\Async\Examples\AsyncVsAwaitables;

require_once "interface.php";

class Ford implements Car {
  public async function drive(): Awaitable<void> {
    // ...
  }
}
