<?hh

namespace Hack\UserDocumentation\TypeAliases\Opaque\Examples\AliasNoConstraint;

// point.php - Point implementation file

newtype Point = (int, int);

function createPoint(int $x, int $y): Point {
  return tuple($x, $y);
}

function setX(Point $p, int $x): Point {
  $p[0] = $x;
  return $p;
}

function setY(Point $p, int $y): Point {
  $p[1] = $y;
  return $p;
}

function getX(Point $p): int {
  return $p[0];
}

function getY(Point $p): int {
  return $p[1];
}

