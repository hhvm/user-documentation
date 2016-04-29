<?hh

namespace Hack\UserDocumentation\Collections\Intro\Examples\Arr;

// array<string, string> is an array map with string keys and string values
function array_as_map(array<string, string> $arr): string {
  $r = substr(str_shuffle('ABCDEF'), 0, 1); // random letter
  return array_key_exists($r, $arr) ? $arr[$r] : 'Z';
}

// array<int> is an array vector with integer keys and integer values
function array_as_vector(array<int> $arr): int {
  $r = rand(0, 10);
  return array_key_exists($r, $arr) ? $arr[$r] : PHP_INT_MAX;
}

function run(): void {
  $v = array(100, 200, 300, 400);
  $v[] = 500; // element 5, value 500
  var_dump($v);
  var_dump(array_as_vector($v));

  $m = array('A' => 'California', 'B' => 'Oregon', 'C' => 'North Carolina');
  $m['D'] = 'Florida';
  var_dump($m);
  var_dump(array_as_map($m));
}

run();
