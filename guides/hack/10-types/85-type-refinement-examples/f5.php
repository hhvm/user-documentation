<?hh // strict

namespace Hack\UserDocumentation\Types\TypeRefinement\Examples\Test5;

class C {
  private ?int $p = 8; // holds an int, but type is ?int
  public function m(): void {
    if ($this->p is int) { // type refinement occurs; $this->p1 is int
      $x = $this->p << 2; // allowed; type is int
      $this->n(); // could involve a permanent type refinement on $p
      //      $x = $this->p << 2;   // disallowed; might no longer be int
    }
  }
  public function n(): void { /* ... */ }
}
