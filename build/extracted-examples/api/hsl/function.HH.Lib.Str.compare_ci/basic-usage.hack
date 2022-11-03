// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Api\Hsl\FunctionHHLibStrCompareCi\BasicUsage;

use namespace HH\Lib\Str;

<<__EntryPoint>>
async function _main(): Awaitable<void> {
  \init_docs_autoloader();

  $comparison_1 = Str\compare_ci("apple", "banana");
  echo "Result of first comparison: $comparison_1 \n";

  $comparison_2 = Str\compare_ci("banana", "apple");
  echo "Result of second comparison: $comparison_2 \n";

  $comparison_3 = Str\compare_ci("apple", "Banana");
  echo "Result of third comparison: $comparison_3 \n";

  $comparison_4 = Str\compare_ci("apple", "Apple");
  echo "Result of fourth comparison: $comparison_4 \n";
}
