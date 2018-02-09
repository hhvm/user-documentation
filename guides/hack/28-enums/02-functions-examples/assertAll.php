<?hh

namespace Hack\UserDocumentation\API\Enums\AssertAllFunc;

enum Day: int {
  SUNDAY = 1;
  MONDAY = 2;
  TUESDAY = 3;
  WEDNESDAY = 4;
  THURSDAY = 5;
  FRIDAY = 6;
  SATURDAY = 7;
}

class MyCalendar {
  public static function get_latest_day_int(Vector<int> $days): Day {
    if (\min($days) > 0 && \max($days) < 8) {
      // We know that all values in $days are in the enum value range,
      // so we can assert that we are converting to one that exists.
      // assertAll returns a Container, so make sure to create a new
      // Vector from it.
      return self::get_latest_day(new Vector(Day::assertAll($days)));
    }
    return Day::SUNDAY;
  }

  public static function get_latest_day(Vector<Day> $days): Day {
    return \max($days);
  }
}

var_dump(MyCalendar::get_latest_day_int(Vector {4, 6, 3})); // int(6)
var_dump(MyCalendar::get_latest_day(
  Vector {Day::WEDNESDAY, Day::SATURDAY})
); // int(7)
