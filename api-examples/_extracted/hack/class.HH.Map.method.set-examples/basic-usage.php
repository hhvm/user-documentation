<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ClassHHMapMethodSet\BasicUsage;

<<__EntryPoint>>
function _main(): void {
  \init_docs_autoloader();

  $m = Map {
    'red' => '#ff0000',
    'green' => '#00ff00',
    'blue' => '#0000ff',
    'yellow' => '#ffff00',
  };

  // Set the value at key 'red'
  $m->set('red', 'rgb(255, 0, 0)');

  // Set the values at keys 'green' and 'blue'
  $m->set('green', 'rgb(0, 255, 0)')
    ->set('blue', 'rgb(0, 0, 255)');

  \var_dump($m);
}
