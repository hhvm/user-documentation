namespace Hack\UserDocumentation\API\Examples\Dict\group_by;
use namespace HH\Lib\Dict;

<<__EntryPoint>>
function main(): void {
  $numbers = vec[1, 1, 2, 3, 5, 8, 14];
  $groups = Dict\group_by($numbers, $value ==> $value % 2);
  \print_r($groups);
}
