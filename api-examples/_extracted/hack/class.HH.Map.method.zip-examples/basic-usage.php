<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ClassHHMapMethodZip\BasicUsage;

<<__EntryPoint>>
function _main(): void {
  \init_docs_autoloader();

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
