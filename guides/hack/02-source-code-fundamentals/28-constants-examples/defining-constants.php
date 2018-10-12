<?hh // strict

namespace Hack\UserDocumentation\Fundamentals\Constants\Examples\DefiningConstants;

class C {
  const float MAX_HEIGHT = 10.5;
  const float UPPER_LIMIT = C::MAX_HEIGHT;
}

<<__Entrypoint>>
function main(): void {

  \define('COEFFICIENT_1', 2.345, false);

  echo "   MAX_HEIGHT = " . C::MAX_HEIGHT . "\n";
  echo "COEFFICIENT_1 = " . \constant("COEFFICIENT_1") . "\n";
}
