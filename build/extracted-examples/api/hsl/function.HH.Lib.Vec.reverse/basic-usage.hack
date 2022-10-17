// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Api\Hsl\FunctionHHLibVecReverse\BasicUsage;

use namespace HH\Lib\Vec;

<<__EntryPoint>>
async function _main(): Awaitable<void> {
  \init_docs_autoloader();

  $vector = vec[1, 2, 3, 4, 5, 6];
  $reversed = Vec\reverse($vector);
  \print_r($reversed);
}
