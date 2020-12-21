// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Api\Hack\ClassHHPairMethodGetIterator\BasicUsage;

<<__EntryPoint>>
async function _main(): Awaitable<void> {
  \init_docs_autoloader();

  $p = Pair {'foo', -1.5};

  // Get a KeyedIterator for the Pair
  $iterator = $p->getIterator();

  // Print both keys and values
  while ($iterator->valid()) {
    echo $iterator->key().' => '.(string)$iterator->current()."\n";
    $iterator->next();
  }
}
