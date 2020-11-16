<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ExpressionsAndOperators\Yield\Squares;

function squares(
  int $start,
  int $end,
  string $keyPrefix = "",
): \Generator<string, int, void> {
  for ($i = $start; $i <= $end; ++$i) {
    yield $keyPrefix.$i => $i * $i; // specify a key/value pair
  }
}

<<__EntryPoint>>
function main(): void {
  \init_docs_autoloader();

  foreach (squares(-2, 3, "X") as $key => $val) {
    echo "key: $key, value: $val\n";
  }
}
