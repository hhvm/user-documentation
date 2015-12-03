<?hh

namespace HHVM\UserDocumentation\Async\Examples\AsyncVsAwaitables;

interface Car {
  // It doesn't matter to the caller how this is implemented, only that it
  // returns an Awaitable<void>
  public function drive(): Awaitable<void>;
}
