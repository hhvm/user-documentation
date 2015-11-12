<?hh

namespace Hack\UserDocumentation\Callables\Intro\Examples\HackCallableGood;

// Use the more expressive syntax instead of the callable typehint
// Using mixed here in case callMe ever got a callback that returned something
// else. But could have used string too.
function callMe((function(): mixed) $callback): mixed {
  $callback();
}

function run(): void {
  $callback = function () {
    echo "Hello!";
  };
  callMe($callback);
}

run();
