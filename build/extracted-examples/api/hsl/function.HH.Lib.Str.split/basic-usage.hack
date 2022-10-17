// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Api\Hsl\FunctionHHLibStrSplit\BasicUsage;

use namespace HH\Lib\Str;

<<__EntryPoint>>
async function _main(): Awaitable<void> {
  \init_docs_autoloader();

  $str = "This, is, a, great, software, for sure.";
  $split_str = Str\split($str, ",");
  \print_r($split_str);

  $split_str2 = Str\split($str, ",", 3);
  \print_r($split_str2);
}
