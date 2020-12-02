```basic-usage.php
function expects_immutable(ImmMap<string, string> $iv): void {
  \var_dump($iv);
}

<<__EntryPoint>>
function basic_usage_main(): void {
  $m = Map {
    'red' => '#ff0000',
    'green' => '#00ff00',
    'blue' => '#0000ff',
    'yellow' => '#ffff00',
  };

  // Get a deep, immutable copy of $m
  $immutable_map = $m->toImmMap();

  expects_immutable($immutable_map);
}
```
