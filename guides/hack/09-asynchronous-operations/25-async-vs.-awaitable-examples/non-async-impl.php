<?hh // strict

namespace Hack\UserDocumentation\AsyncOps\AsyncVsAwaitables\Examples\Impl;

require_once "interface.php";

class VolkswagenDiesel implements Car {
  public function drive(): Awaitable<void> {
    // ...
    return $this->driveNormally();
  }
  private async function driveNormally(): Awaitable<void> {
    // ...
  }
}
