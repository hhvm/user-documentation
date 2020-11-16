<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\Statements\Do\TableOfSquares;

<<__EntryPoint>>
function _main(): void {
  \init_docs_autoloader();

  $i = 1;
  do {
    echo "$i\t".($i * $i)."\n"; // output a table of squares
    ++$i;
  } while ($i <= 10);
}
