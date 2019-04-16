<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Map\Map\Strings;

$m = Map {
  'red' => '#ff0000',
  'green' => '#00ff00',
  'blue' => '#0000ff',
  'yellow' => '#ffff00',
};

$capitalized = $m->map(fun('strtoupper'));
var_dump($capitalized);

$css_colors = $capitalized->map($hex_code ==> "color: {$hex_code};");
var_dump($css_colors);
