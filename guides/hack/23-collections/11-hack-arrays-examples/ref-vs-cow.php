<?hh

namespace Hack\UserDocumentation\Collections\HackArrays\Examples\RefVsCow;

function do_stuff($container) {
  $container[] = 456;
  return $container;
}

function main(): void {
    $a = Vector { 123 };
    $b = do_stuff($a);
    $x = vec[123];
    $y = do_stuff($x);

    var_dump([
        array(
            'in' => $a,
            'out' => $b,
            'mutated' => $a == $b,
        ),
        array(
            'in' => $x,
            'out' => $y,
            'mutated' => $x == $y,
        ),
    ]);
}

main();
