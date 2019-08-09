<?hh // strict

namespace Hack\UserDocumentation\Fundamentals\Names\Examples\SomeNames;

class Data {
  const int MAX_VALUE = 100;
  private int $value = 0;
  /* ... */
}
interface ICollection { /* ... */ }
enum Position: int {
  Top = 0;
  Bottom = 1;
  Left = 2;
  Right = 3;
  Center = 4;
}
function compute(int $val): void {
  $count = $val + 1;
  /* ... */
}
