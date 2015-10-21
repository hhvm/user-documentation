<?hh

namespace Hack\UserDocumentation\Shapes\Examples\Examples\Arbitrary;

type Complex = shape('real' => float, 'imag' => float);
type Hits = shape('id' => string, 'url' => string, 'count' => int);
type Math = shape('n1' => array<num>,
                  'n2' => (function (array<num>): float));
type APoint<T> = shape('x' => T, 'y' => T);

function take_complex(Complex $c): void {
  echo $c['real'] . ' + ' . $c['imag'] . 'i' . PHP_EOL;
}

function get_hits(Hits $h): void {
  echo 'User with id: ' . $h['id'] . ' has hit ' . $h['url'] . ' ' .
       $h['count'] . ' times.' . PHP_EOL;
}

function do_math(Math $m): void {
  var_dump($m['n2']($m['n1']));
}

function create_point<T>(APoint<T> $p): void {
  var_dump($p);
}

function run(): void {
  take_complex(shape('real' => 4.0, 'imag' => 2.0));
  get_hits(shape('id' => 'Rex', 'url' => 'http://example.com', 'count' => 10));
  do_math(shape('n1' => array(2, 4.0, 2, 999, 1000.23),
    'n2' => function (array<num> $nums): float {
      return array_sum(array_filter($nums, $x ==> is_float($x)));
     }
  ));
  create_point(shape('x' => true, 'y' => false));
}

run();
