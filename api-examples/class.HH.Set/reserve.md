This example reserves space for 1000 elements and then fills the `Set` with 1000 integers:

```basic-usage.php no-auto-output
const int SET_SIZE = 1000;

<<__EntryPoint>>
function basic_usage_main(): void {
  $s = Set {};
  $s->reserve(SET_SIZE);

  for ($i = 0; $i < SET_SIZE; $i++) {
    $s[] = $i * 10;
  }

  \var_dump($s);
}
```
