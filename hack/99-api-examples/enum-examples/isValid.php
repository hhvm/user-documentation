<?hh

namespace Hack\UserDocumentation\API\Enums\isValid;

enum Day : int {
  SUNDAY = 1;
  MONDAY = 2;
  TUESDAY = 3;
  WEDNESDAY = 4;
  THURSDAY = 5;
  FRIDAY = 6;
  SATURDAY = 7;
}

function check_value(int $value): bool {
  return isValid($value);
}

var_dump(check_value(3)); // bool(true)
var_dump(check_value(9)); // bool(false)
