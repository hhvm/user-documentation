<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ClassHHMapMethodConstruct\NullEmpty;

<<__EntryPoint>>
function _main(): void {
  \init_docs_autoloader();

  // An empty Map is created if null is provided
  $m = new Map(null);
  \var_dump($m);
}
