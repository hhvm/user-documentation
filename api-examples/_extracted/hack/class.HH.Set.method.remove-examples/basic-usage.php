<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ClassHHSetMethodRemove\BasicUsage;

<<__EntryPoint>>
function _main(): void {
  \init_docs_autoloader();

  $s = Set {'red', 'green'};

  // Remove 'red' from the Set
  $s->remove('red');
  \var_dump($s);

  // Remove 'red' again (has no effect)
  $s->remove('red');
  \var_dump($s);
}
