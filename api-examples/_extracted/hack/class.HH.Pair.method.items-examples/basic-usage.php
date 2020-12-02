<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ClassHHPairMethodItems\BasicUsage;

<<__EntryPoint>>
function _main(): void {
  \init_docs_autoloader();

  $p = Pair {'foo', -1.5};

  // Get an Iterable view of the Pair
  $iterable = $p->items();

  // Print both values in the Iterable
  foreach ($iterable as $value) {
    echo (string)$value."\n";
  }
}
