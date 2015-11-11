<?hh

namespace Hack\UserDocumentation\Generics\Constraints\Examples\Constraint;


class Complex<T as num> {
  private T $real;
  private T $imag;
  public function __construct(T $real, T $imag) {
    $this->real = $real;
    $this->imag = $imag;
  }
  public static function add(Complex<T> $z1, Complex<T> $z2): Complex<T> {
    return new Complex($z1->real + $z2->real, $z1->imag + $z2->imag);
  }

  public function __toString(): string {
    if ($this->imag === 0.0) {
      // Make sure to cast the floating-point numbers to a string.
      return (string) $this->real;
    } else if ($this->real === 0.0) {
      return (string) $this->imag . 'i';
    } else {
      return (string) $this->real . ' + ' . (string) $this->imag . 'i';
    }
  }
}

function run(): void {
  $c1 = new Complex(10.5, 5.67);
  $c2 = new Complex(4, 5);
  // You can add one complex that takes a float and one that takes an int.
  echo "\$c1 + \$c2 = " . Complex::add($c1, $c2) . "\n";
  $c3 = new Complex(5, 6);
  $c4 = new Complex(9, 11);
  echo "\$c3 + \$c4 = " . Complex::add($c3, $c4) . "\n";
}

run();
