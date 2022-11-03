// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Api\Hsl\FunctionHHLibMathToBase\BasicUsage;

use namespace HH\Lib\Math;

<<__EntryPoint>>
async function _main(): Awaitable<void> {
  \init_docs_autoloader();

  $in = 30;

  $base_1 = 10;
  $out_1 = Math\to_base($in, $base_1);
  echo "$in to base $base_1 is $out_1 \n";

  $base_2 = 16;
  $out_2 = Math\to_base($in, $base_2);
  echo "$in to base $base_2 is $out_2 \n";

  $base_3 = 2;
  $out_3 = Math\to_base($in, $base_3);
  echo "$in to base $base_3 is $out_3 \n";
}
