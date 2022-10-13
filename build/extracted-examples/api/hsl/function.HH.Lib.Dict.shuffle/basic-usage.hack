// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Api\Hsl\FunctionHHLibDictShuffle\BasicUsage;

use namespace HH\Lib\Dict;

<<__EntryPoint>>
async function _main(): Awaitable<void> {
  \init_docs_autoloader();

  $keys = vec['k1', 'k2', 'k3', 'k4', 'k5'];
  $values = vec[1, 2, 3, 4, 5];
  $shuffled = Dict\shuffle($keys, $values);
  \print_r($shuffled);

  $keys = vec['k1'];
  $values = vec[1];
  $shuffled = Dict\shuffle($keys, $values);
  \print_r($shuffled);
}
