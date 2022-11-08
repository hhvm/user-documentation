// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Api\Hsl\FunctionHHLibStrUppercaseL\BasicUsage;

use namespace HH\Lib\Str;

<<__EntryPoint>>
async function _main(): Awaitable<void> {
  \init_docs_autoloader();

  $locale = \HH\Lib\Locale\create("en_US.UTF-8");
  $uppercase_string = Str\uppercase_l($locale, 'ifoo');
  echo "Get uppercase string with en_US.UTF-8: $uppercase_string \n";
}
