// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Api\Hack\ClassHHSetMethodGetIterator\BasicUsage;

<<__EntryPoint>>
async function _main(): Awaitable<void> {
  \init_docs_autoloader();

  $s = Set {'red', 'green', 'blue', 'yellow'};

  // Get an iterator for the Set of colors
  $iterator = $s->getIterator();

  // Print each color using the iterator
  while ($iterator->valid()) {
    echo $iterator->current()."\n";
    $iterator->next();
  }
}
