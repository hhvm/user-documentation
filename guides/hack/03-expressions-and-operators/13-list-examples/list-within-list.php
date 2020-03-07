<?hh // strict

namespace Hack\UserDocumentation\ExprAndOps\List\ListWIthinList;

<<__EntryPoint>>
function main(): void {
  $tuple = tuple('top level', tuple('inner', 'nested'));
  list($top_level, list($inner, $nested)) = $tuple;
  echo "top level -> {$top_level}, inner -> {$inner}, nested -> {$nested}\n";
}
