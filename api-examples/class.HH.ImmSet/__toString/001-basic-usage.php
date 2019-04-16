<?hh // partial

namespace Hack\UserDocumentation\API\Examples\ImmSet\__toString;

$is = ImmSet {1, 2, 3};
echo $is."\n";

$is2 = ImmSet {'a', 'b', 'c'};
echo $is2."\n";

$is3 = ImmSet {};
echo $is3."\n";
