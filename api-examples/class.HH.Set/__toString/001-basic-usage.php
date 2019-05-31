<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Set\__toString;

$s = Set {1, 2, 3};
echo $s."\n";

$s2 = Set {'a', 'b', 'c'};
echo $s2."\n";

$s3 = Set {};
echo $s3."\n";
