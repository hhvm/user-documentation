<?hh

namespace Hack\UserDocumentation\Shapes\Functions\Examples\fIdx;

class C {
  const string KEYX = 'x';
  const string KEYY = 'y';
  const int KEYINTX = 10;
  const int KEYINTY = 23;
  const int KEYINTZ = 50;
}

function run(shape('x' => int, 'y' => int, ?'z' => int) $s): void {
  echo "======== Shapes::idx ========\n";

  $v = Shapes::idx($s, 'x');    // field exists, return 10
  echo "\$v = " . (($v == null)? "null" : $v) ."\n";

  $v = Shapes::idx($s, 'y');    // field exists, return 20
  echo "\$v = " . (($v == null)? "null" : $v) ."\n";

  // field does not exist; return implict default, null
  $v = Shapes::idx($s, 'z');
  echo "\$v = " . (($v == null)? "null" : $v) ."\n";

  // field does not exist; return explicit default, -99
  $v = Shapes::idx($s, 'z', -99);
  echo "\$v = " . (($v == null)? "null" : $v) ."\n";

  echo "----------------------------\n";

  $s = shape(C::KEYINTX => 10, C::KEYINTY => 20);

  $v = Shapes::idx($s, C::KEYINTX);   // field exists, return 10
  echo "\$v = " . (($v == null)? "null" : $v) ."\n";

  $v = Shapes::idx($s, C::KEYINTY); // field exists, return 20
  echo "\$v = " . (($v == null)? "null" : $v) ."\n";

  // field does not exist; return implict default, null
  $v = Shapes::idx($s, C::KEYINTZ);
  echo "\$v = " . (($v == null)? "null" : $v) ."\n";

  // field does not exist; return explicit default, -99
  $v = Shapes::idx($s, C::KEYINTZ, -99);
  echo "\$v = " . (($v == null)? "null" : $v) ."\n";
}

run(shape('x' => 10, 'y' => 20));