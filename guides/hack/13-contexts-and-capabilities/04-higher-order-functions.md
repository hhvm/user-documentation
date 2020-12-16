## WARNING WARNING WARNING

This section is under active development and represents an unreleased feature

## Back to your regularly scheduled docs

One may define a higher order function whose context depends on the dynamic context of one or more passed in function arguments.

```
function has_dependent_fn_arg(
  (function()[_]: void) $f,
)[ctx $f]: void {... $f(); ...}
```

One may reference the dependent context of a function argument in later arguments as well as in the return type.

```
function has_double_dependent_fn_arg(
  (function()[_]: void) $f1,
  (function()[ctx $f1]: void) $f2,
)[rand, ctx $f1]: void {
  $f1();
  $f2();
}

function has_dependent_return(
  (function()[_]: void) $f,
)[rand, ctx $f]: (function()[ctx $f]: void) {
  $f();
  return $f;
}
```

The semantics of the argument-dependent-context are such that the higher order function's type is specialized per invocation.

```
function callee(
  (function()[_]: void) $f,
)[rand, ctx $f]: void {... $f(); ...}

function caller()[io, rand]: void {
  // pass pure closure
  callee(()[] ==> {...}); // specialized callee is {Rand}

  // pass {IO} closure
  callee(()[io] ==> echo "output"); // specialized callee is {Rand, IO}
  // pass {IO, Rand} closure
  callee(() ==> {...}); // callee is {Rand, IO}
}
```

Note that this suggests and requires that all other statements within callee require only the Rand capability, as the actual capabilities of the passed argument cannot be depended upon to be any specific capability.