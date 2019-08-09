<?hh // strict

namespace Hack\UserDocumentation\Types\Bool\Examples\LeapYearTest;

function is_leap_year(int $yy): bool {
  return ((($yy & 3) === 0) && (($yy % 100) !== 0)) || (($yy % 400) === 0);
}

<<__EntryPoint>>
function main(): void {
  $result = is_leap_year(1900);
  echo "1900 is ".(($result === true) ? "" : "not ")."a leap year\n";
}
