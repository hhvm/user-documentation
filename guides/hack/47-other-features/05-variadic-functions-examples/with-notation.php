<?hh

namespace Hack\UserDocumentation\OtherFeatures\Variadic\Examples\Good;

class A {}

function add_or_multiply_all(bool $b, ...$nums): int {
  // $nums is an array of arguments
  // filter out all the non-ints

  $nums = \array_filter($nums, $x ==> is_int($x));

  if ($b) {
    return \array_sum($nums);
  }
  return \array_product($nums);
}

function run(): void {
  \var_dump(add_or_multiply_all(true, 3, "Hi", new A(), 4, 9, -2));
  \var_dump(add_or_multiply_all(false, 3, "Hi", new A(), 4, 9, -2));
}

run();

