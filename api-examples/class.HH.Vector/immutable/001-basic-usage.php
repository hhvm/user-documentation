<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Vector\Immutable;

function expects_immutable(ImmVector $iv): void {
  \var_dump($iv);
}

<<__EntryPoint>>
function basic_usage_main(): void {
  $v = Vector {'red', 'green', 'blue', 'yellow'};

  // Get a deep, immutable copy of $v
  $immutable_v = $v->immutable();

  expects_immutable($immutable_v);
}
