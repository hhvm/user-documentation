<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ClassHHSetMethodConstruct\NullEmpty;

<<__EntryPoint>>
function _main(): void {
  \init_docs_autoloader();

  // An empty Set is created if null is provided
  $s = new Set(null);
  \var_dump($s);
}
