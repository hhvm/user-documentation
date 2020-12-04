<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ExpressionsAndOperators\List\IgnoredTupleAssignment;

<<__EntryPoint>>
async function _main(): Awaitable<void> {
  \init_docs_autoloader();

  $tuple = tuple('a', 'b', 'c', 1, 2, 3);
  list($_, $b, $c, $_, $two, $_) = $tuple;
  echo "b -> {$b}, c -> {$c}, two -> {$two}\n";
}
