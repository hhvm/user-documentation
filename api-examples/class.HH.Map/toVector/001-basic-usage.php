<?hh

namespace Hack\UserDocumentation\API\Examples\Map\ToVector;

<<__EntryPoint>>
function basic_usage_main(): void {
  $m = Map {
    'red' => '#ff0000',
    'green' => '#00ff00',
    'blue' => '#0000ff',
    'yellow' => '#ffff00',
  };

  // Make a deep Vector copy of the values of $m
  $v = $m->toVector();

  // Modify $v by adding an element
  $v->add('#663399');
  \var_dump($v);

  // The original Map $m doesn't include the value '#663399'
  \var_dump($m);
}
