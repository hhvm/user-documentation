<?hh // strict

namespace Hack\UserDocumentation\ExpAndOps\FunctionCall\Examples\Closures;

<<__Entrypoint>>
function main(): void {
  $table = vec[
    (function (int $p) { return $p * 2; }),  // doubles
    (function (int $p) { return $p * 5; })   // times 5
  ];

  $i = 0;
  $v = $table[$i++]($i);  // eval is L-to-R
  echo "\$v = $v\n";

  $v = $table[$i](++$i);  // eval is L-to-R
  echo "\$v = $v\n";
}
