<?hh // strict

namespace Hack\UserDocumentation\ExpAndOps\Echo\Examples\Basics;

<<__Entrypoint>>
function main(): void {
  $v1 = true;
  $v2 = 123.45;
  echo  '>>' . $v1 . '|' . $v2 . "<<\n";    // outputs ">>1|123<<"

  $v3 = "abc{$v2}xyz";
  echo "$v3\n";
}
