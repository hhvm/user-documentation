// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Api\Hsl\FunctionHHLibMathAbs\BasicUsage;

use namespace HH\Lib\Math;

<<__EntryPoint>>
async function _main(): Awaitable<void> {
  \init_docs_autoloader();

  $negative_number = -25;
  $negative_number_abs = Math\abs($negative_number);
  echo "Negative test - before: $negative_number after: $negative_number_abs \n";

  $positive_number = 25;
  $positive_number_abs = Math\abs($positive_number);
  echo "Positive test - before: $positive_number after: $positive_number_abs \n";
}
