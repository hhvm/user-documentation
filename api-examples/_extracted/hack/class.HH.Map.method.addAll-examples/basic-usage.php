<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ClassHHMapMethodAddAll\BasicUsage;

<<__EntryPoint>>
function _main(): void {
  \init_docs_autoloader();

  $m = Map {};

  // Add all the key-value pairs in an array
  $m->addAll(varray[Pair {'red', '#ff0000'}]);

  // Map::addAll returns the Map so it can be chained
  $m->addAll(Vector {
    Pair {'green', '#00ff00'},
    Pair {'blue', '#0000ff'},
  })
    ->addAll(ImmVector {
      Pair {'yellow', '#ffff00'},
      Pair {'purple', '#663399'},
    });

  \var_dump($m);
}
