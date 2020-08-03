<?hh // strict

namespace Hack\UserDocumentation\Classes\Constants\Examples\PermittedTypes;

function fInt(): int {
  return 10;
}

enum Position: int {
  Top = 0;
  Bottom = 1;
  Left = 2;
  Right = 3;
  Center = 4;
}

class B {}

class C {
  const bool cBool = true;
  const int cInt = 123;
  //  const int cInt2 = fInt();		// initializer is not a constant
  const float cFloat = 34.56;
  const num cNum = -5;
  const num cNum2 = C::cInt;
  //  const boid cVoid = ???;
  const varray<bool> cString = varray[true, false];
  const (int, string) cTuple = tuple(5, "xxx");
  const shape('x' => int, 'y' => int) cShape = shape('x' => -3, 'y' => 6);
  const arraykey cArraykey = "key";
  const Position cEnumPosition = Position::Bottom;
  const mixed cMixed = 2.34;
  const ?int cNullInt = null;
  //  const Vector<int> cVector = Vector{1, 3, 5};		// initializer is not a constant
  const vec<int> cVec = vec[1, 3, 5];
  //  const Map<string, int> cMap = Map{'oranges' => 25, 'apples' => 12, 'pears' => 17};		// initializer is not a constant
  const dict<string, int> cDict =
    dict['oranges' => 25, 'apples' => 12, 'pears' => 17];
  //  const Set<arraykey> cSet = Set{"red", "white", 123}; 		// initializer is not a constant
  const keyset<arraykey> cKeyset = keyset["red", "white", 123];
  //  const B cB = new B();		// initializer is not a constant
}
