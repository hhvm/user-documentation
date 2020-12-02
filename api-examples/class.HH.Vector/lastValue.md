This example shows how `lastValue()` can be used even when a `Vector` may be empty:

```basic-usage.php
function echoLastValue(Vector<string> $v): void {
  $last_value = $v->lastValue();
  if ($last_value !== null) {
    echo 'Last value: '.$last_value."\n";
  } else {
    echo 'No last value (Vector is empty)'."\n";
  }
}

<<__EntryPoint>>
function basic_usage_main(): void {
  // Will print "Last value: yellow"
  echoLastValue(Vector {'red', 'green', 'blue', 'yellow'});

  // Will print "No last value (Vector is empty)"
  echoLastValue(Vector {});
}
```
