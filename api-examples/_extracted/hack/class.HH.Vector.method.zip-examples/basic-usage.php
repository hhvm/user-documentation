<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ClassHHVectorMethodZip\BasicUsage;

<<__EntryPoint>>
function _main(): void {
  \init_docs_autoloader();

  $v = Vector {'red', 'green', 'blue', 'yellow'};

  $labels = Vector {'My Favorite', 'My 2nd Favorite', 'My 3rd Favorite'};
  $labeled_colors = $v->zip($labels);

  \var_dump($labeled_colors->count()); // 3

  foreach ($labeled_colors as list($color, $label)) {
    echo $label.': '.$color."\n";
  }
}
