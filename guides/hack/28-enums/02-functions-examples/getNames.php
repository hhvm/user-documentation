<?hh

namespace Hack\UserDocumentation\API\Enums\GetNames;

enum Day: int {
  SUNDAY = 1;
  MONDAY = 2;
  TUESDAY = 3;
  WEDNESDAY = 4;
  THURSDAY = 5;
  FRIDAY = 6;
  SATURDAY = 7;
}

function check_name(string $name): bool {
  return \in_array($name, Day::getNames());
}

var_dump(check_name("SUNDAY")); // bool(true)
var_dump(check_name("NOPE")); // bool(false)

/*

Day::getNames() returns this:

array(7) {
  [1]=>
  string(6) "SUNDAY"
  [2]=>
  string(6) "MONDAY"
  [3]=>
  string(7) "TUESDAY"
  [4]=>
  string(9) "WEDNESDAY"
  [5]=>
  string(8) "THURSDAY"
  [6]=>
  string(6) "FRIDAY"
  [7]=>
  string(8) "SATURDAY"
}

*/
