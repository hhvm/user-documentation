<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ClassHHVectorMethodRemoveKey\BasicUsage;

<<__EntryPoint>>
function _main(): void {
  \init_docs_autoloader();

  $v = Vector {'red', 'green', 'blue', 'yellow'};

  // Remove 'blue' at index 2
  $v->removeKey(2);
  \var_dump($v);

  // Remove 'red' and then remove 'green'
  $v->removeKey(0)->removeKey(0);
  \var_dump($v);
}
