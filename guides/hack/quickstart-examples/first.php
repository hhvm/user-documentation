<?hh

// This double slash is a comment, just like PHP, C++, C#, etc. You can also
// use /* ... */ as well.
// All Hack programs start with <?hh

// This namespace is here for purposes of keeping the examples in the
// documentation orderly. Bascically it is an organization tool for your code.
// So users of the class below that are not in the same namespace, will preface
// instantitations of the class with:
// Hack\UserDocumentation\Quickstart\Examples\First\Complex
namespace Hack\UserDocumentation\Quickstart\Examples\First;

// This is how you create a class in Hack
class Complex {
  // These are class properties. They can be public (totally accessible),
  // protected (this class and children), private (only this class)
  private float $real;
  private float $imag;

  // This is a special function on the class called a constructor.
  // __construct is builtin and has that special meaning -- to construct
  // an instance of the class. Here, to construct an instance of
  // ComplexNumber, you pass in two float values, one for the real, one for
  // the imaginary. And then those are assinged to the class properties above
  // for use in other methods of this class.
  public function __construct(float $real, float $imag) {
    // $this is how you access the instance of the class from within the class
    // itself
    $this->real = $real;
    $this->imag = $imag;
  }

  // This is a static method of the class. You call this not by creating
  // an instance of the class, but rather on the class itself.
  // It is taking two parameters, each of type Complex and is returning
  // a Complex.
  public static function add(Complex $c1, Complex $c2): Complex {
    return new Complex($c1->real + $c2->real, $c1->imag + $c2->imag);
  }

  // This is an instance method of the class. You call this when you have
  // created an instance of the class. It takes no parameters and returns
  // a string.
  public function toString(): string {
    // This is an if/else statement.
    // === checks for type and value equality; there is also == which just
    // checks for value equality. Normally === is safer.
    if ($this->imag === 0.0) {
      // strval is a builtin function that converts numbers to strings
      return strval($this->real);
    } else if ($this->real === 0.0) {
      // The . is the string concatenation operator.
      return strval($this->imag) . 'i';
    } else {
      return strval($this->real) . ' + ' . strval($this->imag) . 'i';
    }
  }
}

// This is regular function. It is not in a class. So you just call it by
// its name. It takes no parameters and returns no value.
function run(): void {
  // Create an instance of Complex with new, passing in the appropriate
  // parameters to the constructor
  $c1 = new Complex(3.0, -4.0);
  // Call toString() on the instance of $c1
  // PHP_EOL is the platform independent newline character.
  echo $c1->toString() . PHP_EOL;
  $c2 = new Complex(-9.0, 10.0);
  echo $c2->toString() . PHP_EOL;
  // Calling the static class method via Class::method syntax.
  $c3 = Complex::add($c1, $c2);
  echo $c3->toString() . PHP_EOL;
}

run();
