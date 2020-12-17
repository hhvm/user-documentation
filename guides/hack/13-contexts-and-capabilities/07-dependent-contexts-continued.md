## WARNING WARNING WARNING

This section is under active development and represents an unreleased feature

## Back to your regularly scheduled docs

Dependent contexts may be accessed off of nullable parameters. If the dynamic value of the parameter is null, then the contexts list will be empty.

```
function type_const(
  ?SomeClassWithConstant $t,
  ?(function()[_]: void) $f,
)[$t::C, ctx $f]: void {
  $t?->foo();
  if ($f is nonnull) {
    $f();
  }
}
```

Parameters used for accessing a dependent context may not be reassigned within the function body.

```
function nope(SomeClassWithConstant $t, (function()[_]: void) $f)[$t::C, ctx $f]: void {
  // disallowed
  $t = get_some_other_value();
  $f = get_some_other_value();  
}
```

Dependent contexts may not be referenced within the body of a function. This restriction may be relaxed in a future version.

```
function f(
  (function()[_]: void $f,
  SomeClassWithConstant $t,
)[rand, ctx $f, $t::C]: void {
  (()[ctx $f] ==> 1)();    // Disallowed
  (()[$t::C] ==> 1)();    // Disallowed
  (()[rand] ==> 1)(); // Allowed, not a dependent context
  (()[] ==> 1)();     // Allowed
  (() ==> 1)();       // Allowed. Note that this is logically equivalent to [rand, ctx $f, $t::C]
}
```