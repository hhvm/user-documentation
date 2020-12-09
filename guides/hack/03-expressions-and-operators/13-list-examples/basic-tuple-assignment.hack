// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ExpressionsAndOperators\List\BasicTupleAssignment;

<<__EntryPoint>>
async function _main(): Awaitable<void> {
  \init_docs_autoloader();

  $tuple = tuple('one', 'two', 'three');
  list($one, $two, $three) = $tuple;
  echo "1 -> {$one}, 2 -> {$two}, 3 -> {$three}\n";
}
