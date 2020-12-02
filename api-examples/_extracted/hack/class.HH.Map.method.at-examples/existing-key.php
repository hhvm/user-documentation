<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ClassHHMapMethodAt\ExistingKey;

<<__EntryPoint>>
function _main(): void {
  \init_docs_autoloader();

  $m = Map {
    'red' => '#ff0000',
    'green' => '#00ff00',
    'blue' => '#0000ff',
    'yellow' => '#ffff00',
  };

  // Print the value at the key 'red'
  \var_dump($m->at('red'));

  // Print the value at the key 'yellow'
  \var_dump($m->at('yellow'));
}
