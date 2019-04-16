<?hh // partial

namespace Hack\UserDocumentation\API\Examples\ImmMap\__toString;

$im = ImmMap {'a' => 1, 'b' => 2, 'c' => 3};
echo $im."\n";

$im3 = ImmMap {};
echo $im3."\n";
