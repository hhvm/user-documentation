// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Api\Hsl\FunctionHHLibDictFillKeys\BasicUsage;

use namespace HH\Lib\Dict;

<<__EntryPoint>>
async function _main(): Awaitable<void> {
  \init_docs_autoloader();

  $keys = vec['k1', 'k2', 'k3', 'k4'];
  $value = 5;
  $dict = Dict\fill_keys($keys, $value);
  \print_r($dict);
}
