<?hh

namespace Hack\UserDocumentation\Fundamentals\Literals\Examples\NowdocLiterals;

<<__EntryPoint>>
function main(): void {
  $v = 123;
  $s = <<<    'ID'
S'o'me "\"t e\txt; \$v = $v"
Some more text
ID;
  echo ">$s<\n\n";
}
