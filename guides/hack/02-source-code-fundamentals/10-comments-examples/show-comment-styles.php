<?hh // strict

namespace Hack\UserDocumentation\Fundamentals\Comments\Examples\UseComments;

/* Class Point represents a point in a two-dimensional Cartesian
coordinate system. */

class Point {
  private float $x;    // x-coordinate
  private float $y;    #  y-coordinate
  public function __construct(num $x = 0, num $y = 0) {
    $this->x = (float)$x;  // initialize private field $x
    $this->y = (float)$y;  /* initialize private field $y */
  }
  // ...
}