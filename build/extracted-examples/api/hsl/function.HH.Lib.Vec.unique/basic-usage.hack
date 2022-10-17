// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Api\Hsl\FunctionHHLibVecUnique\BasicUsage;

use namespace HH\Lib\Vec;

<<__EntryPoint>>
async function _main(): Awaitable<void> {
  \init_docs_autoloader();

  $vector = vec[1, 1, 2, 3, 4, 4, 4, 4];
  $uniqueVals = Vec\unique($vector);
  \print_r($uniqueVals);
}
