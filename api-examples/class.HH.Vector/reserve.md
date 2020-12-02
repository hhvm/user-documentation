This example reserves space for 1000 elements and then fills the `Vector` with 1000 integers:

```basic-usage.php no-auto-output
const int VECTOR_SIZE = 1000;

<<__EntryPoint>>
function basic_usage_main(): void {
  $v = Vector {};
  $v->reserve(VECTOR_SIZE);

  for ($i = 0; $i < VECTOR_SIZE; $i++) {
    $v[] = $i * 10;
  }

  \var_dump($v);
}
```
