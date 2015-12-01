<?hh

namespace Hack\UserDocumentation\API\Enums\Coerce;

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
  public static function get_next_day_int(int $day): ?Day {
    // coerce will return null if the underlying type value isn't an enum
    // member value
    $coerced = Day::coerce($day);
    return $coerced ? self::get_next_day($coerced) : null;
  }

  public static function get_next_day(Day $day): ?Day {
    // assert here two since we want to cast to add the days
    return $day !== Day::SATURDAY ? Day::assert((int) $day + 1) : Day::SUNDAY;
  }
}

var_dump(MyCalendar::get_next_day_int(4)); // int(5)
var_dump(MyCalendar::get_next_day(Day::SATURDAY)); // int(1)
