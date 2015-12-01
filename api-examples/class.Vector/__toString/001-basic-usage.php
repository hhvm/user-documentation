<?hh

namespace Hack\UserDocumentation\API\Examples\ImmVector\__toString;

$iv = ImmVector {1, 2, 3};
echo $iv."\n";

$iv2 = ImmVector {'a', 'b', 'c'};
echo $iv2."\n";

$iv3 = ImmVector {};
echo $iv3."\n";
