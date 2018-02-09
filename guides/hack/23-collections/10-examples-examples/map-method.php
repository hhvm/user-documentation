<?hh

namespace Hack\UserDocumentation\Collections\Examples\Examples\MapM;

function apply_prefix(Vector<string> $phrases): Vector<string> {
  return $phrases->map($x ==> 'Hello ' . $x);
  // We used a lambda above. This could have also been written as:
  //return $phrases->map(function (string $x): string {return 'Hello' . $x;});
}

function run(): void {
  $phrases = Vector {'Joel', 'Rex', 'Fred', 'Matthew', 'Tim', 'Jez'};
  \var_dump(apply_prefix($phrases));
}

run();
