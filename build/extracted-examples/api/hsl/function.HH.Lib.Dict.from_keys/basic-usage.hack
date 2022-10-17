// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Api\Hsl\FunctionHHLibDictFromKeys\BasicUsage;

use namespace HH\Lib\Dict;

<<__EntryPoint>>
async function _main(): Awaitable<void> {
  \init_docs_autoloader();

  $keys = vec[1, 2, 3, 4];
  $dict = Dict\from_keys($keys, $x ==> $x + 1);
  \print_r($dict);

  $values = vec[1, 2, 3, 4];
  $dict = Dict\from_keys($keys, $x ==> 5);
  \print_r($dict);
}
