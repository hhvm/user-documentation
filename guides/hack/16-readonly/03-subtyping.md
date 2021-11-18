From a typing perspective, one can think of a readonly object as a [supertype](/hack/types/supertypes-and-subtypes) of its mutable counterpart.
For example, readonly values cannot be passed to a function that takes mutable values.

``` Hack readonly_takes_mutable.hack.type-errors
<<file:__EnableUnstableFeatures("readonly")>>
class Foo {
  public int $prop = 0;
}

function takes_mutable(Foo $x): void {
  $x->prop = 4;
}

function test(): void {
    $z = readonly new Foo();
    takes_mutable($z); // error, takes_mutable's first parameter
                       // is mutable, but $z is readonly
}
```

Similarly, functions cannot return readonly values unless they are annotated to return readonly.

``` Hack readonly_return.hack.type-errors
<<file:__EnableUnstableFeatures("readonly")>>
class Foo {}
function returns_mutable(readonly Foo $x): Foo {
  return $x; // error, $x is readonly
}
function returns_readonly(readonly Foo $x): readonly Foo {
  return $x; // correct
}
```

Note that non-readonly (i.e. mutable) values *can* be passed to a function that takes a readonly parameter:

``` Hack readonly_takes.hack
<<file:__EnableUnstableFeatures("readonly")>>
class Foo {}
// promises not to modify $x
function takes_readonly(readonly Foo $x): void {
}

function test(): void {
    $z = new Foo();
    takes_readonly($z); // ok
}
```

Similarly, class properties cannot be set to readonly values unless they are declared as readonly properties.

``` Hack readonly_prop_assign.hack.type-errors
<<file:__EnableUnstableFeatures("readonly")>>
class Bar {}
class Foo {
  public function __construct(
    public readonly Bar $ro_prop,
    public Bar $mut_prop
  ){}
}

function test(
  Foo $x,
  readonly Bar $bar,
) : void {
  $x->mut_prop = $bar; // error, $bar is readonly but the prop is mutable
  $x->ro_prop = $bar; // ok
}
```