// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Api\Hsl\FunctionHHLibDictFromValues\Hack;

use namespace HH\Lib\Dict;

<<__EntryPoint>>
async function _main(): Awaitable<void> {
  \init_docs_autoloader();

  $values = vec[1, 2, 3, 4];
  $dict = Dict\from_values($values, $x ==> $x + 1);
  \print_r($dict);

  $values = vec[1, 2, 3, 4];
  $dict = Dict\from_values($values, $x ==> 5);
  \print_r($dict);
}
