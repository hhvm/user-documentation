// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ExpressionsAndOperators\Echo\Basics;

<<__EntryPoint>>
async function _main(): Awaitable<void> {
  \init_docs_autoloader();

  $v1 = true;
  $v2 = 123.45;
  echo '>>'.$v1.'|'.$v2."<<\n"; // outputs ">>1|123.45<<"

  $v3 = "abc{$v2}xyz";
  echo "$v3\n";
}
