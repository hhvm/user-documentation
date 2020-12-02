<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ClassHHVectorMethodResize\BasicUsage;

<<__EntryPoint>>
function _main(): void {
  \init_docs_autoloader();

  $v = Vector {'red', 'green', 'blue', 'yellow'};

  // Resize the Vector to 2 (removing 'blue' and 'yellow')
  $v->resize(2, null);
  \var_dump($v);

  // Resize the Vector back to 4 (filling in 'unknown' for new elements)
  $v->resize(4, 'unknown');
  \var_dump($v);
}
