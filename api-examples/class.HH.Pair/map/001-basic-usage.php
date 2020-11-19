<?hh

namespace Hack\UserDocumentation\API\Examples\Pair\Map\Strings;

<<__EntryPoint>>
function basic_usage_main(): void {
  $p = Pair {null, -1.5};

  $immutable_v = $p->map($value ==> {
    if ($value === null) {
      return 0;
    }
    return $value;
  });
  \var_dump($immutable_v);
}
