<?hh

namespace Hack\UserDocumentation\Types\Nothing\Examples\EmptyContainer;

use namespace HH\Lib\Str;

interface DontForgetToImplementShipIt {
  public function shipIt(nothing $_): mixed;
}

abstract class Software implements DontForgetToImplementShipIt {
}

class HHVM extends Software {
  public function shipIt(string $version): string {
    return 'Shipping HHVM version '.$version.'!';
  }
}

class HSL extends Software {
  private function __construct(public bool $has_new_functions) {
  }

  public function shipIt(bool $has_new_functions): HSL {
    return new HSL($has_new_functions);
  }
}

class HHAST extends Software {
  public function shipIt(Container<string> $linters): void {
    foreach ($linters as $linter) {
      invariant(
        Str\ends_with($linter, 'Linter'),
        'Linter %s does not have a name that ends in "Linter"!',
        $linter,
      );
    }
  }
}
