<?hh // partial

namespace HHVM\UserDocumentation\BasicUsage\Examples\CommandLine;

function fibonacci(int $number): int {
  return \intval(\round(\pow((\sqrt(5.0) + 1) / 2, $number) / \sqrt(5.0)));
}

function main(array<string> $argv) {
  $n = (int) ($argv[1] ?? 10);
  echo 'The '.
    $n.
    ' number in fibonacci is: '.
    fibonacci($n).
    \PHP_EOL;
}

main($argv);
