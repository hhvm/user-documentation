<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ClassHHSetMethodAddAll\BasicUsage;

<<__EntryPoint>>
function _main(): void {
  \init_docs_autoloader();

  $s = Set {};

  // Add all the values in a Vector
  $s->addAll(Vector {'a', 'b'});

  // Add all the values in a Set
  $s->addAll(Set {'c', 'd'});

  // Add all the values in a Map
  $s->addAll(Map {'foo' => 'e', 'bar' => 'f'});

  // Add all the values in an array
  $s->addAll(varray['g', 'h']);

  // Set::addAll returns the Set so it can be chained
  $s->addAll(ImmSet {'i', 'j'})
    ->addAll(ImmVector {'k', 'l'});

  \var_dump($s);
}
