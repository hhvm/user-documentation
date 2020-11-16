<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ExpressionsAndOperators\List\ListWithinList;

<<__EntryPoint>>
function _main(): void {
  \init_docs_autoloader();

  $tuple = tuple('top level', tuple('inner', 'nested'));
  list($top_level, list($inner, $nested)) = $tuple;
  echo "top level -> {$top_level}, inner -> {$inner}, nested -> {$nested}\n";
}
