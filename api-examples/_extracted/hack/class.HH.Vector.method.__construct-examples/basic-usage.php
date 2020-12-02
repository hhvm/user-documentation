<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ClassHHVectorMethodConstruct\BasicUsage;

<<__EntryPoint>>
function _main(): void {
  \init_docs_autoloader();

  // Create a new Vector from an array
  $v = new Vector(varray['red', 'green', 'blue', 'yellow']);
  \var_dump($v);

  // Create a new Vector from a Set
  $v = new Vector(Set {'red', 'green', 'blue', 'yellow'});
  \var_dump($v);

  // Create a new Vector from the values of a Map
  $v = new Vector(Map {
    'red' => 'red',
    'green' => 'green',
    'blue' => 'blue',
    'yellow' => 'yellow',
  });
  \var_dump($v);
}
