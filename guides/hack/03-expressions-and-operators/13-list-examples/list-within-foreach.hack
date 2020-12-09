// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ExpressionsAndOperators\List\ListWithinForeach;

<<__EntryPoint>>
async function _main(): Awaitable<void> {
  \init_docs_autoloader();

  $vec_of_tuples = vec[
    tuple('A', 'B', 'C'),
    tuple('a', 'b', 'c'),
    tuple('X', 'Y', 'Z'),
  ];

  foreach ($vec_of_tuples as list($first, $second, $third)) {
    echo "{$first} {$second} {$third}\n";
  }
}
