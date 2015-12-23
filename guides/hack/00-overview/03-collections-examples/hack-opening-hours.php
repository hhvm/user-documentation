<?hh

namespace Hack\UserDocumentation\Overview\Collections\Examples\HackOpeningHours;

require __DIR__ . '/dayofweek-enum.php';

use \Hack\UserDocumentation\Overview\Collections\Examples\DayOfWeek;

function getOpeningHours(DayOfWeek $x): ?string {
  $opening_hours = Vector {
    "9-5",
    "9-5",
    "9-9",
    "9-9",
    "9-9",
    "9-6",
    "12-5",
  };
  // Since Vector::get() takes an int, we need to convert the enum to
  // the underlying value
  return $opening_hours->get(DayOfWeek::assert($x));
}

echo getOpeningHours(DayOfWeek::Wednesday);
