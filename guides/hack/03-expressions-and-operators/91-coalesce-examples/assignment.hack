namespace Hack\UserDocumentation\ExpAndOps\Coalesce\Assignment;
use namespace HH\Lib\{Dict, Str};

function get_counts_by_value(Traversable<string> $values): dict<string, int> {
  $counts_by_value = dict[];
  foreach ($values as $value) {
    $counts_by_value[$value] ??= 0;
    ++$counts_by_value[$value];
  }
  return $counts_by_value;
}

function get_people_by_age(
  KeyedTraversable<string, int> $ages_by_name,
): dict<int, vec<string>> {
  $people_by_age = dict[];
  foreach ($ages_by_name as $name => $age) {
    $people_by_age[$age] ??= vec[];
    $people_by_age[$age][] = $name;
  }
  return $people_by_age;
}

<<__EntryPoint>>
function main(): void {
  $values = vec['foo', 'bar', 'foo', 'baz', 'bar', 'foo'];
  \print_r(get_counts_by_value($values));

  $people = dict[
    'Arthur' => 35,
    'Ford' => 110,
    'Trillian' => 35,
    'Zaphod' => 120,
  ];
  \print_r(
    get_people_by_age($people)
    |> Dict\map($$, $names ==> Str\join($names, ', '))
  );
}
