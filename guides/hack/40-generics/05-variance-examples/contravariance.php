<?hh

namespace Hack\UserDocumentation\Generics\Variance\Examples\Contravariance;

// This class is write only. Had we put in a getter for $this->t, we could not
// use contravariance. e.g., if we had function getMe(T $x): T, you would get
// con.php:10:28,28: Illegal usage of a contravariant type
//                   parameter (Typing[4121])
//  con.php:5:10,10: This is where the parameter was declared as
//                   contravariant (-)
//  con.php:10:28,28: Function return types are covariant
class C<-T> {
  public function __construct(private T $t) {}
  public function setMe(T $val): void {
    $this->t = $val;
  }
}

class Animal {}
class Cat extends Animal {}

function main(): void {
  $animal = new Animal();
  $cat = new Cat();
  $c = new C($cat);
  // calling setMe with Animal on an instance of C that was initialized with Cat
  $c->setMe($animal);
  \var_dump($c);
}

main();
