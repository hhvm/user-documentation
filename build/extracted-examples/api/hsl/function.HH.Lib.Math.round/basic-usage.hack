// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Api\Hsl\FunctionHHLibMathRound\BasicUsage;

use namespace HH\Lib\Math;

<<__EntryPoint>>
async function _main(): Awaitable<void> {
  \init_docs_autoloader();

  $round1 = Math\round(8.65);
  echo "8.65 rounded to default precision 0 yields $round1 \n";

  $round2 = Math\round(8.65, 1);
  echo "8.65 rounded to precision 1 yields $round2 \n";

  $round3 = Math\round(8.65, -1);
  echo "8.65 rounded to precision -1 yields $round3 \n";
}
