// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ExpressionsAndOperators\Yield\ProcessFile;

use type HHVM\UserDocumentation\LocalConfig;

function getTextFileLines(string $filename): \Generator<int, string, void> {
  $infile = \fopen($filename, 'r');
  if ($infile === false) {
    // handle file-open failure
  }

  try {
    while (true) {
      $textLine = \fgets($infile);
      if ($textLine === false) {
        break;
      }
      $textLine = \rtrim($textLine, "\r\n"); // strip off line terminator
      yield $textLine;
    }
  } finally {
    \fclose($infile);
  }
}

<<__EntryPoint>>
function main(): void {
  \init_docs_autoloader();

  $path = LocalConfig::ROOT.'/src/utils/examples/Testfile.txt';
  foreach (getTextFileLines($path) as $line) {
    echo ">$line<\n";
  }
}
