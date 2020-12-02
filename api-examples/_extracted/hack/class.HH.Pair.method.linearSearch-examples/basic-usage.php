<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ClassHHPairMethodLinearSearch\BasicUsage;

<<__EntryPoint>>
function _main(): void {
  \init_docs_autoloader();

  $p = Pair {'foo', -1.5};

  // Prints 0 (the index of the first value)
  \var_dump($p->linearSearch('foo'));

  // Prints 1 (the index of the second value)
  \var_dump($p->linearSearch(-1.5));

  // Prints -1 (the value doesn't exist in the Pair)
  \var_dump($p->linearSearch('bar'));
}
