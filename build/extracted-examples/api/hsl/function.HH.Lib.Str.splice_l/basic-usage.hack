// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Api\Hsl\FunctionHHLibStrSpliceL\BasicUsage;

use namespace HH\Lib\Str;

<<__EntryPoint>>
async function _main(): Awaitable<void> {
  \init_docs_autoloader();

  $locale = \HH\Lib\Locale\create("en_US.UTF-8");
  $result = Str\splice_l($locale, "apple", "orange", 5, 0);
  echo "Splice string with en_US.UTF-8: $result \n";
}
