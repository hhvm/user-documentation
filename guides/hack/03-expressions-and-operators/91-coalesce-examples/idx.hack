// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ExpressionsAndOperators\Coalesce\Idx;

<<__EntryPoint>>
function _main(): void {
  \init_docs_autoloader();

  $arr = dict['black' => 10, 'white' => null];
  \print_r(vec[
    idx($arr, 'black', -100),  // 10
    idx($arr, 'white', -200),  // null
    idx($arr, 'green', -300),  // -300
    idx($arr, 'green'),        // null
  ]);
}
