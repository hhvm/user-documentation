<?hh

namespace Hack\UserDocumentation\API\Examples\Set\Contains;

<<__EntryPoint>>
function basic_usage_main(): void {
  $s = Set {'red', 'green', 'blue', 'yellow'};

  // Prints "true", since $s contains "red"
  \var_dump($s->contains('red'));

  // Prints "false", since $s doesn't contain "blurple"
  \var_dump($s->contains('blurple'));
}
