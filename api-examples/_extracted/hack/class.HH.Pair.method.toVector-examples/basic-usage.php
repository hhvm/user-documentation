<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ClassHHPairMethodToVector\BasicUsage;

<<__EntryPoint>>
function _main(): void {
  \init_docs_autoloader();

  $p = Pair {'foo', -1.5};

  $v = $p->toVector();
  \var_dump($v);
}
