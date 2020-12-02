<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ClassHHMapMethodToValuesArray\BasicUsage;

<<__EntryPoint>>
function _main(): void {
  \init_docs_autoloader();

  $m = Map {
    'red' => '#ff0000',
    'green' => '#00ff00',
    'blue' => '#0000ff',
    'yellow' => '#ffff00',
  };

  $array = $m->toValuesArray();

  \var_dump(\HH\is_any_array($array));
  \var_dump($array);
}
