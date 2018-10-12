<?hh // strict

namespace Hack\UserDocumentation\Fundamentals\Literals\Examples\DQVariableSubstitution;

class C {
    public int $p1 = 2;
}

<<__Entrypoint>>
function main(): void {
  $x = 123;
  echo ">\$x.$x"."<\n";

  $myC = new C();
  echo "\$myC->p1 = >$myC->p1<\n";
}
