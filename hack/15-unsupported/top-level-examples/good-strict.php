<?hh // strict

namespace Hack\UserDocumentation\Unsupported\TopLevel\Examples\GoodStrict;

require __DIR__ . "/include-partial.inc";

function foo(int $x): void {
  echo $x + $x;
}

function call_foo(): void {
  foo(5);
}
