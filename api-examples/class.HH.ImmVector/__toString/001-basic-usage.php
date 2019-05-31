<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Vector\__toString;

$v = Vector {1, 2, 3};
echo $v."\n";

$v2 = Vector {'a', 'b', 'c'};
echo $v2."\n";

$v3 = Vector {};
echo $v3."\n";
