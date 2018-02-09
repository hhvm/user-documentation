<?hh

namespace Hack\UserDocumentation\Tuples\Introduction\Examples\CreateAndAnnotate;

function find_longest_and_index(array<string> $strs): (string, int) {
  $longest_index = -1;
  $longest_str = "";
  foreach ($strs as $index => $str) {
    if (\strlen($str) > \strlen($longest_str)) {
      $longest_str = $str;
      $longest_index = $index;
    }
  }
  return tuple($longest_str, $longest_index);
}

function run(): void {
  $strs = array("ABCDE", "tjkdsfjkwewowe", "Hello, this is an intro of tuples");
  \var_dump(find_longest_and_index($strs));
}

run();
