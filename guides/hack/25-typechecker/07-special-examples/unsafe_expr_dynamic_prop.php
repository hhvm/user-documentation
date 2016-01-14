<?hh //strict

namespace Hack\UserDocumentation\Typechecker\Special\Examples\UnsafeDP;

class Ranking {
  public function __construct(
    protected int $first,
    protected int $second,
    protected int $third,
  ) {}

  public function copyFields(Ranking $from): Ranking {
    foreach (['first', 'second', 'third'] as $field) {
      /* UNSAFE_EXPR */ $this->$field = $from->$field;
    }
    return $this;
  }
}

/*
Without the UNSAFE_EXPR, you would get an error like this from the typechecker.

unsafe_expr_dynamic_prop.php:14:14,19: Dynamic method call (Naming[2011])
*/
