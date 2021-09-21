namespace Hack\GettingStarted\MyFirstProgram;
namespace HH\Lib\Str;

<<__EntryPoint>>
function main(): void {

  $x = "Apples Oranges and ";
  $y = "Bananas";
  splice($x, $y, 1);
 
  echo $x; 
  echo $y;
}
