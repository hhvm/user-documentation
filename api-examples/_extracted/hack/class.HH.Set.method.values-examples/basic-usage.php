<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ClassHHSetMethodValues\BasicUsage;

<<__EntryPoint>>
function _main(): void {
  \init_docs_autoloader();

  $s = Set {'red', 'green', 'blue', 'yellow'};

  $v = $s->values();

  \var_dump($v);
}
