<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ClassHHSetMethodContains\BasicUsage;

<<__EntryPoint>>
function _main(): void {
  \init_docs_autoloader();

  $s = Set {'red', 'green', 'blue', 'yellow'};

  // Prints "true", since $s contains "red"
  \var_dump($s->contains('red'));

  // Prints "false", since $s doesn't contain "blurple"
  \var_dump($s->contains('blurple'));
}
