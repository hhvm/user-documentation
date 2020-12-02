<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ClassHHMapMethodFromItems\BasicUsage;

<<__EntryPoint>>
function _main(): void {
  \init_docs_autoloader();

  // Create a new Map from an array of key-value pairs
  $m = Map::fromItems(varray[
    Pair {'red', '#ff0000'},
    Pair {'green', '#00ff00'},
    Pair {'blue', '#0000ff'},
    Pair {'yellow', '#ffff00'},
  ]);
  \var_dump($m);

  // Create a new Map from a Vector of key-value pairs
  $m = Map::fromItems(Vector {
    Pair {'red', '#ff0000'},
    Pair {'green', '#00ff00'},
    Pair {'blue', '#0000ff'},
    Pair {'yellow', '#ffff00'},
  });
  \var_dump($m);

  // An empty Map is created if null is provided
  $m = Map::fromItems(null);
  \var_dump($m);
}
