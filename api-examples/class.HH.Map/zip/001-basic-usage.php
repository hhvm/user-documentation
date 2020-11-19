<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Map\Zip;

<<__EntryPoint>>
function basic_usage_main(): void {
  $m = Map {
    'red' => '#ff0000',
    'green' => '#00ff00',
    'blue' => '#0000ff',
    'yellow' => '#ffff00',
    'purple' => '#663399',
  };

  $labels = Vector {'My Favorite', 'My 2nd Favorite', 'My 3rd Favorite'};
  $labeled_colors = $m->zip($labels);

  \var_dump($labeled_colors->count()); // 3

  foreach ($labeled_colors as $color => $pair) {
    $hex_code = $pair[0];
    $label = $pair[1];
    echo "{$label}: {$color} ($hex_code)\n";
  }
}
