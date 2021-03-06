// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Api\Hack\ClassHHVectorMethodGetIterator\BasicUsage;

<<__EntryPoint>>
async function _main(): Awaitable<void> {
  \init_docs_autoloader();

  $v = Vector {'red', 'green', 'blue', 'yellow'};

  // Get an iterator for the Vector of colors
  $iterator = $v->getIterator();

  // Print each color using the iterator
  while ($iterator->valid()) {
    echo $iterator->current()."\n";
    $iterator->next();
  }
}
