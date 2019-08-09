<?hh // strict

namespace Hack\UserDocumentation\Classes\Inheritance\Examples\ColoredPoint;

enum Color: int {
  // ...
}

class Point {
  public function __construct(num $x, num $y) {
    // ...
  }
}

class ColoredPoint extends Point {
  public function __construct(num $x, num $y, Color $col) {
    parent::__construct($x, $y); // initialize the base Point
    // ...
  }
}
