<?hh

namespace HHVM\UserDocumentation\Async\Examples\AsyncVsAwaitables;

require_once "interface.php";

class VolkswagenDiesel implements Car {
  public function drive(): Awaitable<void> {
    $being_tested = \class_exists(
      \Facebook\HackTest\HackTest::class,
      /* autoload = */ false,
    );

    // As these two functions return Awaitable<void>, we can just pass along
    // their Awaitables.
    if ($being_tested) {
      return $this->driveWithCleanEmissions();
    }
    return $this->driveNormally();
  }

  private async function driveWithCleanEmissions(): Awaitable<void> {
    // ...
  }

  private async function driveNormally(): Awaitable<void> {
    // ...
  }
}
