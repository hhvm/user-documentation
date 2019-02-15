<?hh // strict

namespace Hack\UserDocumentation\Classes\Serialization\Examples\PointTest2;
include_once "ColoredPoint.php";

<<__EntryPoint>>
function main(): void {
  $cp = new \Hack\UserDocumentation\Classes\Serialization\Examples\ColoredPoint\ColoredPoint(9, 8, 
    \Hack\UserDocumentation\Classes\Serialization\Examples\ColoredPoint\Color::BLUE);
  $s = \serialize($cp);
  \var_dump($s);

  $v = \unserialize($s);
  \var_dump($v);
}
