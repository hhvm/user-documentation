<?hh

namespace Hack\UserDocumentation\Shapes\Introduction\Examples\ClassConstants;

class C2 {
  const string KEYA = 'x';
  const string KEYB = 'y';
  const int KEYX = 10;
  const int KEYY = 23;
}

type PointS = shape(C2::KEYA => int, C2::KEYB => int);
type PointI = shape(C2::KEYX => int, C2::KEYY => int);

function print_pointS(PointS $p): void {
  var_dump($p);
}

function print_pointI(PointI $p): void {
  var_dump($p);
}

function run(): void {
  print_pointI(shape(C2::KEYX => -1, C2::KEYY => 2));
  print_pointS(shape(C2::KEYA => -1, C2::KEYB => 2));
}

run();

