// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\Statements\For\TableOfSquares;

<<__EntryPoint>>
async function _main(): Awaitable<void> {
  \init_docs_autoloader();

  for ($i = 1; $i <= 5; ++$i) {
    echo "$i\t".($i * $i)."\n"; // output a table of squares
  }

  $i = 1;
  for (; $i <= 5; ) {
    echo "$i\t".($i * $i)."\n"; // output a table of squares
    ++$i;
  }

  $i = 1;
  for (; ; ) {
    if ($i > 5)
      break;
    echo "$i\t".($i * $i)."\n"; // output a table of squares
    ++$i;
  }
}
