// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ExpressionsAndOperators\Yield\ProcessFile;

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

  foreach (getTextFileLines(__DIR__."/Testfile.txt") as $line) {
    echo ">$line<\n";
  }
}
