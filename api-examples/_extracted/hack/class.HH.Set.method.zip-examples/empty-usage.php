<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ClassHHSetMethodZip\EmptyUsage;

<<__EntryPoint>>
function _main(): void {
  \init_docs_autoloader();

  // The $traversable is empty so the result will be empty
  $s = Set {'red', 'green', 'blue', 'yellow'};
  $zipped = $s->zip(Vector {});
  \var_dump($zipped);

  // The Set $s is empty so the result will be empty
  $s = Set {};
  $zipped = $s->zip(Vector {'My Favorite', 'My Second Favorite'});
  \var_dump($zipped);
}
