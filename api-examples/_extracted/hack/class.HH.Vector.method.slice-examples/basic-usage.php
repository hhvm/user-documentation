<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ClassHHVectorMethodSlice\BasicUsage;

<<__EntryPoint>>
function _main(): void {
  \init_docs_autoloader();

  $v = Vector {'red', 'green', 'blue', 'yellow'};

  // Start at index 1 ('green') and include 3 elements
  $v2 = $v->slice(1, 3);

  \var_dump($v2);
}
