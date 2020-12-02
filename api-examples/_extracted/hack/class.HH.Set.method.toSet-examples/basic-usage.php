<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ClassHHSetMethodToSet\BasicUsage;

<<__EntryPoint>>
function _main(): void {
  \init_docs_autoloader();

  $s = Set {'red', 'green', 'blue', 'yellow'};

  // Make a deep copy of Set $s
  $s2 = $s->toSet();

  // Modify $s2 by adding an element
  $s2->add('purple');
  \var_dump($s2);

  // The original Set $s doesn't include 'purple'
  \var_dump($s);
}
