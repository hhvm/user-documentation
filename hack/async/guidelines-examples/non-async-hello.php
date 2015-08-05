<?hh

function get_hello(): string {
  return "Hello";
}

function run_na_hello(): void {
  var_dump(get_hello());
}

run_na_hello();
