<?hh // strict

namespace Hack\UserDocumentation\AsyncOps\Examples\Examples\Closures;

<<__EntryPoint>>
async function closure_async(): Awaitable<void> {
  // closure
  $hello = async function(): Awaitable<string> {
    return 'Hello';
  };
  // lambda
  $bye = async ($str) ==> $str;

  // The call style to either closure or lambda is the same
  $rh = await $hello();
  $rb = await $bye("bye");

  echo $rh." ".$rb.\PHP_EOL;
}
