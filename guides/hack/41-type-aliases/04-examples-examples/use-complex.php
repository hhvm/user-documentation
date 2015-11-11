<?hh

// use-complex.php

namespace Hack\UserDocumentation\TypeAliases\Examples\Examples\ComplexNumber;

require_once 'complex.inc.php';

function run(): void {
  $z1 = getI();
  echo "\$z1 contains " . toString($z1) ."\n";

  $z2 = createComplex();
  echo "\$z2 contains " . toString($z2) ."\n";

  $z3 = createComplex(10.0);
  echo "\$z3 contains " . toString($z3) ."\n";

  $z4 = createComplex(-4.0, 3.5);
  echo "\$z4 contains " . toString($z4) ."\n";

  echo "\$z4's real part is " . getReal($z4) ."\n";
  echo "\$z4's imaginary part is " . getImag($z4) ."\n";

  $z2 = setReal($z2, -3.0);
  $z2 = setImag($z2, 2.67);
  echo "\$z2 contains " . toString($z2) ."\n";

  $z5 = add($z2, $z4);
  echo "\$z5 contains \$z2 + \$z4: " . toString($z5) ."\n";

  $z6 = subtract($z2, $z4);
  echo "\$z6 contains \$z2 - \$z4: " . toString($z6) ."\n";
}

run();
