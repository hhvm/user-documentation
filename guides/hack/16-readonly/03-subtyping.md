From a typing perspective, one can think of a readonly object as a [supertype](/hack/types/supertypes-and-subtypes) of its mutable counterpart.
For example, readonly values can not be passed to a function that takes mutable values.

``` Hack
function takes_mutable(Foo $x): void {
  $x->prop = 4;
}

function test(): void {
    $z = readonly new Foo();
    takes_mutable($z); // error, takes_mutable's first parameter
                       // is mutable, but $z is readonly
}
```

Similarly, functions can not return readonly values unless they are marked to return readonly.

``` Hack
function returns_mutable(readonly Foo $x): Foo {
  return $x; // error, $x is readonly
}
```

Note that non readonly (mutable) values *can* be passed to a function that takes a readonly parameter:

``` Hack
// promises not to modify $x
function takes_readonly(readonly Foo $x): void {
}

function test(): void {
    $z = new Foo();
    takes_readonly($z); // ok
}
```

Similarly, class properties can not be set to readonly values unless they are declared as readonly properties.

``` Hack
class Foo {
  readonly Bar $ro_prop;
  Bar $mut_prop;
}

function test(
  Foo $x,
  readonly Bar $bar,
) : void {
  $x->mut_prop = $bar; // error, $bar is readonly but the prop is mutable
  $x->ro_prop = $bar; // ok
}
```