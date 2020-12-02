```basic-usage.php
function expects_immutable(ImmSet<string> $is): void {
  \var_dump($is);
}

<<__EntryPoint>>
function basic_usage_main(): void {
  $s = Set {'red', 'green', 'blue', 'yellow'};

  // Get a deep, immutable copy of $s
  $immutable_s = $s->immutable();

  expects_immutable($immutable_s);
}
```
