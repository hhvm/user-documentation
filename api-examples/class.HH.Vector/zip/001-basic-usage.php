<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Vector\Zip;

<<__EntryPoint>>
function basic_usage_main(): void {
  $v = Vector {'red', 'green', 'blue', 'yellow'};

  $labels = Vector {'My Favorite', 'My 2nd Favorite', 'My 3rd Favorite'};
  $labeled_colors = $v->zip($labels);

  \var_dump($labeled_colors->count()); // 3

  foreach ($labeled_colors as list($color, $label)) {
    echo $label.': '.$color."\n";
  }
}
