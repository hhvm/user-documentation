// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ExpressionsAndOperators\Yield\Series;

function series(
  int $start,
  int $end,
  int $incr = 1,
): \Generator<int, int, void> {
  for ($i = $start; $i <= $end; $i += $incr) {
    yield $i;
  }
}

<<__EntryPoint>>
function main(): void {
  \init_docs_autoloader();

  foreach (series(5, 15, 2) as $key => $val) {
    echo "key: $key, value: $val\n";
  }
  echo "-----------------\n";

  foreach (series(25, 20, 3) as $key => $val) {
    echo "key: $key, value: $val\n";
  }
  echo "-----------------\n";
}
