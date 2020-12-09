// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\BuiltInTypes\Void\DrawLine;

function draw_line(Point $p1, Point $p2): void { /* ... */ }

class Point {
  private float $x;
  private float $y;
  public function __construct(num $x = 0, num $y = 0) {
    $this->x = (float)$x;
    $this->y = (float)$y;
  }
  public function move(num $x = 0, num $y = 0): void {
    $this->x = (float)$x;
    $this->y = (float)$y;
  }
  // ...
}

<<__EntryPoint>>
function main(): void {
  \init_docs_autoloader();

  draw_line(new Point(1.2, 3.3), new Point(6.2, -4.5));
}
