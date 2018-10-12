<?hh

namespace Hack\UserDocumentation\Async\Guidelines\Examples\NonAsyncHello;

function get_hello(): string {
  return "Hello";
}

<<__Entrypoint>>
function run_na_hello(): void {
  \var_dump(get_hello());
}

