// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Api\Hsl\FunctionHHLibVecSlice\BasicUsage;

use namespace HH\Lib\Vec;

<<__EntryPoint>>
async function _main(): Awaitable<void> {
  \init_docs_autoloader();

  $vector = vec[1, 2, 3, 4, 5, 6, 7];
  $sliced_vector = Vec\slice($vector, 3);
  \print_r($sliced_vector);

  $sliced_vector2 = Vec\slice($vector, 2, 3);
  \print_r($sliced_vector2);
}
