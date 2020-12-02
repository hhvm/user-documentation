<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ClassHHPairMethodToVArray\BasicUsage;

<<__EntryPoint>>
function _main(): void {
  \init_docs_autoloader();

  $p = Pair {'foo', -1.5};

  $array = $p->toVArray();

  \var_dump(\HH\is_any_array($array));
  \var_dump($array);
}
