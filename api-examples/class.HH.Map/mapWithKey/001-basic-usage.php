<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Map\MapWithKey;

$m = Map {
  'red' => '#ff0000',
  'green' => '#00ff00',
  'blue' => '#0000ff',
  'yellow' => '#ffff00',
};

$css_colors = $m->mapWithKey(
  ($color, $hex_code) ==> "color: {$hex_code}; /* {$color} */"
);

echo implode("\n", $css_colors)."\n";
