A soft type hint `@Foo` allows you to add types to code without
crashing if you get the type wrong.

```Hack
function probably_int(@int $x): @int {
  return $x + 1;
}

function definitely_int(int $x): int {
  return $x + 1;
}
```

Calling `definitely_int("foo")` will produce an error at runtime,
whereas `probably_int("foo")` will only log a warning.

The type checker treats both `definitely_int` and `probably_int` the
same way. Code completion and type checks are identical.

Soft type hints are useful when migrating partial code or very dynamic
code to strict mode. Once you've fixed your code, and you're not
seeing any more warnings, then you can remove the `@`.
