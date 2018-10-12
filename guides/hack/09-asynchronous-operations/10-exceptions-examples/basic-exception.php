<?hh // strict

namespace Hack\UserDocumentation\AsyncOps\Exceptions\Examples\BasicException;

async function exception_thrower(): Awaitable<void> {
  throw new \Exception("Return exception handle");
}

async function basic_exception(): Awaitable<void> {
  try {
    await exception_thrower();
  }
  catch (\Exception $e) {
  	// ...
  }
}

<<__Entrypoint>>
function main(): void {
  \HH\Asio\join(basic_exception());
}

