```basic-usage.php
function expects_immutable(ImmVector<mixed> $iv): void {
  \var_dump($iv);
}

<<__EntryPoint>>
function basic_usage_main(): void {
  $v = Vector {'red', 'green', 'blue', 'yellow'};

  // Get a deep, immutable copy of $v
  $immutable_v = $v->immutable();

  expects_immutable($immutable_v);
}
```
