<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ClassHHVectorMethodAt\ExistingKey;

<<__EntryPoint>>
function _main(): void {
  \init_docs_autoloader();

  $v = Vector {'red', 'green', 'blue', 'yellow'};

  // Print the first element
  \var_dump($v->at(0));

  // Print the last element
  \var_dump($v->at(3));
}
