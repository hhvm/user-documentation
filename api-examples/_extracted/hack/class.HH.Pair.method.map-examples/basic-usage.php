<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ClassHHPairMethodMap\BasicUsage;

<<__EntryPoint>>
function _main(): void {
  \init_docs_autoloader();

  $p = Pair {null, -1.5};

  $immutable_v = $p->map($value ==> {
    if ($value === null) {
      return 0;
    }
    return $value;
  });
  \var_dump($immutable_v);
}
