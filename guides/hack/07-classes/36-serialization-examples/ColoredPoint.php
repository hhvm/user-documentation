<?hh // partial

namespace Hack\UserDocumentation\Classes\Serialization\Examples\ColoredPoint;
include_once "Point.php";

enum Color: int {
  RED = 1;
  WHITE = 2;
  BLUE = 3;
}

class ColoredPoint extends \Hack\UserDocumentation\Classes\Serialization\Examples\Point\Point implements \Serializable {
  private Color $color; // an instance property

  public function __construct(num $x = 0, num $y = 0, Color $color = Color::RED) {
    parent::__construct($x, $y);
    $this->color = $color;
  }

  public function __toString(): string {
    return parent::__toString() . $this->color;
  }

  public function serialize(): string {
    return \serialize(array(
      'color' => $this->color,
      'baseData' => parent::serialize()
    ));
  }

  public function unserialize(/*string*/ $data): void {
    $data = \unserialize($data);
    $this->color = $data['color'];
    parent::unserialize($data['baseData']);
  }
}
