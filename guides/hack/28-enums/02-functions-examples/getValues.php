<?hh

namespace Hack\UserDocumentation\API\Enums\GetValues;

enum Day: int {
  SUNDAY = 1;
  MONDAY = 2;
  TUESDAY = 3;
  WEDNESDAY = 4;
  THURSDAY = 5;
  FRIDAY = 6;
  SATURDAY = 7;
}

var_dump(Day::getValues());

/*

Day::getValues() returns this:

array(7) {
  ["SUNDAY"]=>
  int(1)
  ["MONDAY"]=>
  int(2)
  ["TUESDAY"]=>
  int(3)
  ["WEDNESDAY"]=>
  int(4)
  ["THURSDAY"]=>
  int(5)
  ["FRIDAY"]=>
  int(6)
  ["SATURDAY"]=>
  int(7)
}

*/
