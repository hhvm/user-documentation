<?hh // strict

namespace Hack\UserDocumentation\Types\Int\Examples\LeapYearTest;

function is_leap_year(int $yy): bool {
  return ((($yy & 3) === 0) && (($yy % 100) !== 0)) || (($yy % 400) === 0);
}

<<__EntryPoint>>
function main(): void {
  $year = 2001;
  $result = is_leap_year($year);
  echo "$year is ".(($result === true) ? "" : "not ")."a leap year\n";
}
