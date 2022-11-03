// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Api\Hsl\FunctionHHLibMathFromBase\BasicUsage;

use namespace HH\Lib\Math;

<<__EntryPoint>>
async function _main(): Awaitable<void> {
  \init_docs_autoloader();

  $val1 = Math\from_base("101", 2);
  echo "101 in base 2 represents the number $val1 \n";

  $val2 = Math\from_base("e", 16);
  echo "e in base 16 represents the number $val2 \n";
}
