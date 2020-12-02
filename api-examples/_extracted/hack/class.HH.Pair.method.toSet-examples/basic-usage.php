<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ClassHHPairMethodToSet\BasicUsage;

<<__EntryPoint>>
function _main(): void {
  \init_docs_autoloader();

  // This Pair contains 'foo' twice
  $p = Pair {'foo', 'foo'};

  $s = $p->toSet();
  \var_dump($s);
}
