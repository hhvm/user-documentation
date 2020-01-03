<?hh // strict

namespace Hack\UserDocumentation\ExpAndOps\Yield\Examples\ProcessFile;

function getTextFileLines(string $filename): \Generator<int, string, void> {
  $infile = \fopen($filename, 'r');
  if ($infile === false) {
    // handle file-open failure
  }

  try {
    while (true) {
      $textLine = \fgets($infile);
      if (!$textLine) {
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
  foreach (getTextFileLines(__DIR__."/Testfile.txt") as $line) {
    echo ">$line<\n";
  }
}
