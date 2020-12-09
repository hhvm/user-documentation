<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\Statements\While\TableOfSquares;

<<__EntryPoint>>
async function _main(): Awaitable<void> {
  \init_docs_autoloader();

  $i = 1;
  while ($i <= 10) {
    echo "$i\t".($i * $i)."\n"; // output a table of squares
    ++$i;
  }
}
