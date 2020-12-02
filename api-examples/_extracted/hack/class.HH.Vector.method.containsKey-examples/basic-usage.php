<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ClassHHVectorMethodContainsKey\BasicUsage;

<<__EntryPoint>>
function _main(): void {
  \init_docs_autoloader();

  $v = Vector {'red', 'green', 'blue', 'yellow'};

  // Prints "true", since index 0 is the first element
  \var_dump($v->containsKey(0));

  // Prints "true", since index 3 is the last element
  \var_dump($v->containsKey(3));

  // Prints "false", since index 10 doesn't exist
  \var_dump($v->containsKey(10));
}
