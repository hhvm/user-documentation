<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Set\ToImmSet;

$s = Set {'red', 'green', 'blue', 'yellow'};

function expects_immutable(ImmSet<string> $is): void {
  \var_dump($is);
}

// Get a deep, immutable copy of $s
$immutable_s = $s->toImmSet();

expects_immutable($immutable_s);
