<?hh

namespace Hack\UserDocumentation\API\Enums\AssertFunc;

enum Day : int {
  SUNDAY = 1;
  MONDAY = 2;
  TUESDAY = 3;
  WEDNESDAY = 4;
  THURSDAY = 5;
  FRIDAY = 6;
  SATURDAY = 7;
}

class MyCalendar {
  public static function get_next_day_int(int $day): Day {
    if ($day > 0 && $day < 8) {
      // We know that $day is in the enum value range, so we can assert that
      // we are converting to one that exists.
      return self::get_next_day(Day::assert($day));
    }
    return Day::SUNDAY;
  }

  public static function get_next_day(Day $day): Day {
    // assert here two since we want to cast to add the days
    return $day !== Day::SATURDAY ? Day::assert((int) $day + 1) : Day::SUNDAY;
  }
}

var_dump(MyCalendar::get_next_day_int(4)); // int(5)
var_dump(MyCalendar::get_next_day(Day::SATURDAY)); // int(1)
