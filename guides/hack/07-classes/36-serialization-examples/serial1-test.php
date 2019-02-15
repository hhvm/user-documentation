<?hh // strict

namespace Hack\UserDocumentation\Classes\Serialization\Examples\PointTest1;
include_once "Point.php";

<<__EntryPoint>>
function main(): void {
  $p = new \Hack\UserDocumentation\Classes\Serialization\Examples\Point\Point(2, 5);
  echo "\$p: $p\n";

  $s = \serialize($p);
  \var_dump($s);

  $v = \unserialize($s);
  \var_dump($v);
}
