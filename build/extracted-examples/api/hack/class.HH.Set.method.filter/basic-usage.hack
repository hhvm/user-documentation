// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Api\Hack\ClassHHSetMethodFilter\BasicUsage;

<<__EntryPoint>>
async function _main(): Awaitable<void> {
  \init_docs_autoloader();

  $colors = Set {'red', 'green', 'blue', 'yellow'};

  // Create a Set of colors that contain the letter 'l'
  $l_colors = $colors->filter($color ==> \strpos($color, 'l') !== false);
  \var_dump($l_colors);
}
