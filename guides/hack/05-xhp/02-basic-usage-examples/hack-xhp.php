<?hh

namespace Hack\UserDocumentation\XHP\BasicUsage\Examples\HackXHP;

require __DIR__ . "/../../../../vendor/autoload.php";

class A {
  public function get_int(): int {
    return 4;
  }
}

function get_string(): string {
  return "Hello";
}

function get_float(): float {
  return 1.2;
}
function embed_hack(): void {
  $xhp_float = <i>{get_float()}</i>;
  $a = new A();
  // You can embed on XHP object into another like we do with $xhp_float here.
  echo
    <div>
       {$a->get_int()}
       <strong>{get_string()}</strong>
       {$xhp_float}
    </div>;
}

embed_hack();
