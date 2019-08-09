<?hh

namespace Hack\UserDocumentation\Generics\ReifiedGenerics\Examples\TypeTesting;

function filter<<<__Enforceable>> reify T>(vec<mixed> $list): vec<T> {
  $ret = vec[];
  foreach ($list as $elem) {
    if ($elem is T) {
      $ret[] = $elem;
    }
  }
  return $ret;
}

<<__EntryPoint>>
function main(): void {
  filter<int>(vec[1, "hi", true]);
  // => vec[1]
  filter<string>(vec[1, "hi", true]);
  // => vec["hi"]
}
