<?hh // strict

namespace Hack\UserDocumentation\Types\Nothing\Examples\IfFalse;

<<__EntryPoint>>
function main(): noreturn {
  $number_of_boats = 2;
  if (false) {
    // $number_of_boats can not be observed to have a type here.
    // The typesystem models this as being `nothing`.
    // The typechecker allows this code to pass without errors.
    $number_of_boats->callingAMethodOnNothing();
  }

  exit();
}
