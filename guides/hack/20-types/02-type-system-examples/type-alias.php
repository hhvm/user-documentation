<?hh

namespace Hack\UserDocumentation\Types\TypeSystem\Examples\TypeAlias;

type ID = int;
type Name = string;

class Customers {
  private array<ID, Name> $c;
  public function __construct() {
    $this->c = array();
    $this->c[0] = "Joel";
    $this->c[1] = "Fred";
    $this->c[2] = "Jez";
    $this->c[3] = "Tim";
    $this->c[4] = "Matthew";
  }

  public function get_name(ID $id): ?Name {
    if (!\array_key_exists($id, $this->c)) {
      return null;
    }
    return $this->c[$id];
  }

  public function get_id(Name $name): ?ID {
    $key = \array_search($name, $this->c);
    return $key ? $key : null;
  }
}

function ts_type_alias(): void {
  $c = new Customers();
  \var_dump($c->get_name(0));
  \var_dump($c->get_id("Fred"));
  \var_dump($c->get_id("NoName"));
}

ts_type_alias();
