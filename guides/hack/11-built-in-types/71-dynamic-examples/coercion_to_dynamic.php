<?hh

function f(dynamic $d): void {}
function g(arraykey $a): void {}

function caller(int $i): void {
  f($i); // int ~> dynamic
  g($i); // int ~> arraykey by subtyping
}
