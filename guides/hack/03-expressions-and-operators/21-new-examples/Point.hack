<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ExpressionsAndOperators\New\Point;

class Point {
  private static int $pointCount = 0; // static property with initializer
  private float $x; // instance property
  private float $y; // instance property

  public function __construct(num $x = 0, num $y = 0) { // instance method
    $this->x = (float)$x; // access instance property
    $this->y = (float)$y; // access instance property
    ++Point::$pointCount; // include new Point in Point count
  }

  public function __toString(): string { // instance method
    return '('.$this->x.','.$this->y.')';
  }
  // ...
}

<<__EntryPoint>>
function main(): void {
  \init_docs_autoloader();

  $p1 = new Point(); // create Point(0.0, 0.0)
  /* HH_FIXME[4067] implicit __toString() is now deprecated */
  echo "\$p1 is $p1\n";

  $p2 = new Point(12.3); // create Point(12.3, 0.0)
  /* HH_FIXME[4067] implicit __toString() is now deprecated */
  echo "\$p2 is $p2\n";

  $p3 = new Point(5, 6.7); // create Point(5.0, 6.7)
  /* HH_FIXME[4067] implicit __toString() is now deprecated */
  echo "\$p3 is $p3\n";
}
