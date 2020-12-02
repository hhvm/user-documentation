<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ClassHHVectorMethodFilterWithKey\BasicUsage;

<<__EntryPoint>>
function _main(): void {
  \init_docs_autoloader();

  $v = Vector {'red', 'green', 'blue', 'yellow', 'purple'};

  // Only include elements with an odd index
  $odd_elements = $v->filterWithKey(($index, $color) ==> ($index % 2) !== 0);

  \var_dump($odd_elements);
}
