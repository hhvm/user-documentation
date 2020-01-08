<?hh // strict

namespace Hack\UserDocumentation\ExpAndOps\FunctionCall\Examples\Closures;

<<__EntryPoint>>
function main(): void {
  $table = vec[
    (
      function(int $p) {
        return $p * 2;
      }
    ), // doubles
    (
      function(int $p) {
        return $p * 5;
      }
    ), // times 5
  ];

  $i = 0;
  $v = $table[$i]($i + 1);
  echo "\$v = $v\n";

  $i++;
  $v = $table[$i]($i + 1);
  echo "\$v = $v\n";
}
