<?hh // strict

namespace Hack\UserDocumentation\Types\Enums\Examples\TestMethods;

require_once("Positions.inc.php");
use Hack\UserDocumentation\Types\Enums\Examples\Positions\Position as Position;

<<__EntryPoint>>
function main(): void {
  $names = Position::getNames();
  echo " Position::getNames() ---\n";
  foreach ($names as $key => $value) {
    echo "\tkey >$key< has value >$value<\n";
  }

  $values = Position::getValues();
  echo "Position::getValues() ---\n";
  foreach ($values as $key => $value) {
    echo "\tkey >$key< has value >$value<\n";
  }
}
