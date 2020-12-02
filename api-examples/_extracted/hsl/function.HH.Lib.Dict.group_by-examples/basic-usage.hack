// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hsl\FunctionHHLibDictGroupBy\BasicUsage;

use namespace HH\Lib\Dict;

<<__EntryPoint>>
function _main(): void {
  \init_docs_autoloader();

  $numbers = vec[1, 1, 2, 3, 5, 8, 14];
  $groups = Dict\group_by($numbers, $value ==> $value % 2);
  \print_r($groups);
}
