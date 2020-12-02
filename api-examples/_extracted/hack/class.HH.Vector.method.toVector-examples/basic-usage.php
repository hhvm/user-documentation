<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ClassHHVectorMethodToVector\BasicUsage;

<<__EntryPoint>>
function _main(): void {
  \init_docs_autoloader();

  $v = Vector {'red', 'green', 'blue', 'yellow'};

  // Make a new Vector that is a copy of $v (i.e. contains the same elements)
  $v2 = $v->toVector();

  // Modify $v2 by adding an element
  $v2->add('purple');
  \var_dump($v2);

  // The original Vector $v doesn't include 'purple'
  \var_dump($v);
}
