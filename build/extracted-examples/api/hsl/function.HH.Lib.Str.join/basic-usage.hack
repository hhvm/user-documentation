// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Api\Hsl\FunctionHHLibStrJoin\BasicUsage;

use namespace HH\Lib\Str;

<<__EntryPoint>>
async function _main(): Awaitable<void> {
  \init_docs_autoloader();

  $strings= vec["a", "b", "c", "d"];

  $joined_string_1 = Str\join($strings, ",");
  echo "First string: $joined_string_1 \n";

  $joined_string_2 = Str\join($strings, "-");
  echo "Second string: $joined_string_2";
}
