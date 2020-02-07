<?hh // strict

namespace Hack\UserDocumentation\Types\Enums\Examples\As;

enum Duck: string {
  MALLARD = 'mallard';
  POMERANIAN = 'pomeranian';
}

$definitely_duck = 'mallard' as Duck; // converts to Duck, throws if not
$maybe_duck = 'grebe' ?as Duck; // converts to ?Duck; null if is not a valid value (grebes are not ducks, so this will be null).