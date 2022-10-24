// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\Statements\Try\Simple;

use namespace HH\Lib\Math;

function do_it(int $x, int $y): void {
  try {
    $result = $x / $y;
    echo "\$result = $result\n";
    // ...
  }
  /*
  catch (\HH\Lib\Math\DivisionByZeroException $ex) {
    echo "Caught a DivisionByZeroException\n";
    // ...
  }
  */
  catch (\Exception $ex) {
    echo "Caught an Exception\n";
    // ...
  }
}

<<__EntryPoint>>
function main(): void {
  \init_docs_autoloader();

  do_it(100, 5);
  //  do_it(6, 0);
}
