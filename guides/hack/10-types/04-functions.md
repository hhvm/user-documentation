Function types are declared with a `(function(sometype, othertype): returntype)`
syntax.

```Hack
function call_function((function(): void) $f): void {
  $f();
}

function demo(): void {
  call_function(() ==> { echo "hello world\n"; });
}
```

