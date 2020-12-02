<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ClassHHMapMethodSetAll\BasicUsage;

<<__EntryPoint>>
function _main(): void {
  \init_docs_autoloader();

  $m = Map {
    'red' => '#ff0000',
    'green' => '#00ff00',
    'blue' => '#0000ff',
    'yellow' => '#ffff00',
  };

  // Set the values at keys 'red' and 'green'
  $m->setAll(Map {
    'red' => 'rgb(255, 0, 0)',
    'green' => 'rgb(0, 255, 0)',
  });

  // Set the values at keys 'blue' and 'yellow' with an associative array
  $m->setAll(darray[
    'blue' => 'rgb(0, 0, 255)',
    'yellow' => 'rgb(255, 255, 0)',
  ]);

  \var_dump($m);
}
