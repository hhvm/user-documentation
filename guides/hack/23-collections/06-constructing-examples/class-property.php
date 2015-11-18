<?hh

namespace Hack\UserDocumentation\Collections\Constructing\Examples\ClassProp;

class A {
  public static Map<int, string> $users = Map {};
  public static array<int, string> $users_a = array();
  // Cannot do something like this because function calls
  // aren't allowed in static class property initializers
  //public static Map<int, string> $users_bad = Map {rand(0, 10) => 'a'};
}

function run(): void {
  A::$users[0] = "Joel";
  A::$users_a[0] = "Fred";
  var_dump(A::$users);
  var_dump(A::$users_a);
}

run();

