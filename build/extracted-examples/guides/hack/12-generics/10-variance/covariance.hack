// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\Generics\Variance\Covariance;

// This class is readonly. Had we put in a setter for $this->t, we could not
// use covariance. e.g., if we had function setMe(T $x), you would get this
// cov.php:9:25,25: Illegal usage of a covariant type parameter (Typing[4120])
//   cov.php:7:10,10: This is where the parameter was declared as covariant (+)
//   cov.php:9:25,25: Function parameters are contravariant
class C<+T> {
  public function __construct(private T $t) {}
}

class Animal {}
class Cat extends Animal {}

function f(C<Animal> $p1): void {
  \var_dump($p1);
}

function g(varray<Animal> $p1): void {
  \var_dump($p1);
}

<<__EntryPoint>>
function run(): void {
  \init_docs_autoloader();

  f(new C(new Animal()));
  f(new C(new Cat())); // accepted

  g(varray[new Animal(), new Animal()]);
  g(varray[new Cat(), new Cat(), new Animal()]); // arrays are covariant
}
