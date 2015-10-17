<?hh

require __DIR__ . "/../../../../vendor/autoload.php";

class basic_usage_examples_A {
  public function get_int(): int {
    return 4;
  }
}

function basic_usage_examples_get_string(): string {
  return "Hello";
}

function basic_usage_examples_get_float(): float {
  return 1.2;
}

function basic_usage_examples_embed_hack(): void {
  $xhp_float = <i>{basic_usage_examples_get_float()}</i>;
  $a = new basic_usage_examples_A();
  // You can embed on XHP object into another like we do with $xhp_float here.
  echo
    <div>
       {$a->get_int()}
       <strong>{basic_usage_examples_get_string()}</strong>
       {$xhp_float}
    </div>;
}

basic_usage_examples_embed_hack();
