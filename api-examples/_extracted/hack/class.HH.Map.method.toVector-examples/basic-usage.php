<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ClassHHMapMethodToVector\BasicUsage;

<<__EntryPoint>>
function _main(): void {
  \init_docs_autoloader();

  $m = Map {
    'red' => '#ff0000',
    'green' => '#00ff00',
    'blue' => '#0000ff',
    'yellow' => '#ffff00',
  };

  // Make a deep Vector copy of the values of $m
  $v = $m->toVector();

  // Modify $v by adding an element
  $v->add('#663399');
  \var_dump($v);

  // The original Map $m doesn't include the value '#663399'
  \var_dump($m);
}
