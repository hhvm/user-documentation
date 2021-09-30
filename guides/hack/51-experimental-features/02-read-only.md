This page describes the *readonly* experimental feature.

## What is it?
`readonly` is a keyword that prohibits mutability on [Objects](https://docs.hhvm.com/hack/classes/introduction) and their properties.

## Enabling readonly
In your relevant file(s), add `<<file:__EnableUnstableFeatures('readonly')>>`.

## How does it work?
When an Object has the `readonly` keyword applied (e.g. `private readonly Foo $x;`, there are two new constraints on that Object.
* **Readonlyness:** Object properties can not be modified (i.e. mutated).
* **Deepness:** All nested properties are readonly.

### Readonlyness
Object properties can not be modified (i.e. mutated).

``` Hack
function test(readonly Foo $x) : void {
  $x->prop = 4; // error, $x is readonly, its properties can not be modified
}
```

### Deepness
All nested properties are readonly.

``` Hack
class Bar {
  public function __construct(
    public Foo $foo,
  )
}

class Foo {
  public function __construct(
    public int $prop,
  )
}

function test(readonly Bar $x) : void {
  $foo = $x->foo;
  $foo->prop = 3; // error, $foo is readonly
}
```

## How is it different from Coeffects?
[Coeffects](https://docs.hhvm.com/hack/contexts-and-capabilities/available-contexts-and-capabilities) affects an entire function (and all the functions it calls), whereas readonly affects values / expressions.

## Applications
This is a list of all of the valid locations of the keyword.

### Parameters and return values
Parameters and return values of any callable can be marked `readonly`.

``` Hack
function foo(readonly Foo $x): readonly Bar {
  return $x->bar;
}
```

A readonly *parameter* signals that the function/method will not modify that parameter; a readonly *return type* signals that the function returns a readonly reference to an object that can not be modified.

### Static and regular properties
Static and regular properties can be marked `readonly` and, when applied, can not be modified.

``` Hack
class Foo {
  private readonly Bar $bar;
  private static readonly Bar $static_bar;
}
```

#### Other restrictions
Accessing a readonly property (i.e. a property that’s marked readonly at the declaration, not accessing a property off of a readonly object) requires readonly annotation.

``` Hack
class Foo {
  public function __construct(
    readonly Bar $bar,
  )
}

function test(Foo $f): void {
  $bar = readonly $f->bar; // this is required
}
```

And, class properties can not be set to readonly values unless they are readonly properties.

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

### Lambdas and function type signatures
`readonly` is allowed on inner parameters and return types on function typehints.

``` Hack
function call(
    (function(readonly Bar) : readonly Bar) $f,
    readonly Bar $arg,
   ) : readonly Bar {
   return $f($arg);
}
```

### Expressions
`readonly` can appear on expressions.

``` Hack
function foo(): void {
  $x = new Foo();
  $y = readonly $x;
}
```

### Functions / Methods
`readonly` can appear as a modifier on instance methods, signaling that `$this` is readonly.

``` Hack
class C {
  public readonly function bar(): Bar {
    return new Bar();
  }
  public readonly function foo() : void {
    $this->prop = 5; // error, $this is readonly.
  }
}
```

#### Other restrictions
Readonly objects can only call readonly methods.

``` Hack
class C {
  public readonly function bar(): Bar {
    return new Bar();
  }
  public readonly function foo() : void {
    $this->prop = 5; // error, $this is readonly.
  }
}
```

Readonly values can not be passed to a function that takes mutable values.

``` Hack
function takes_mutable(Foo $x): void {
  $x->prop = 4;
}

$z : readonly
takes_mutable($z); // error, takes_mutable's first parameter
                   // is mutable, but $z is readonly
```

And, functions can not return readonly values unless they are marked to return readonly.

``` Hack
function returns_mutable(readonly Foo $x): Foo {
  return $x; // error, $x is readonly
}
```

### Closures
A function type can be marked readonly: `readonly function(T1): T`.

## Interactions with [Coeffects](https://docs.hhvm.com/hack/contexts-and-capabilities/available-contexts-and-capabilities)
If your function only has the `ReadGlobals` capability (i.e. is marked `read_globals`) it can only access class static variables if they are wrapped in a readonly expression:

``` Hack
function read_static()[read_globals]: void {
  $y = readonly Foo::$bar; // keyword required
}
function read_static()[policied]: void {
  $y = readonly Foo::$bar; // keyword required
}
```

### Calling a readonly function
Calling a function or method that returns readonly requires wrapping the result in a readonly expression.

``` Hack
function returns_readonly(): readonly Foo {
  return readonly new Foo();
}

function test(): void {
  $x = readonly returns_readonly(); // this is required to call returns_readonly()
}
```

## Converting to non-readonly
Sometimes you may encounter a readonly value that isn’t an object (i.e. a readonly int, due to the deepness property of readonly). In those cases, instead of returning a readonly int, you’ll want a way to tell Hack that the value you have is actually a value type. You can use the function `HH\Readonly\as_mut()` to convert any primitive type from readonly to mutable.

Use `HH\Readonly\as_mut()` strictly for primitive types and value-type collections of primitive types (i.e. a vec of int).

``` Hack
class Foo {
  public function __construct(
    public int $prop,
  )

  public readonly function get() : int {
    $result = $this->prop; // here, $result is readonly, but its also an int.
    return HH\Readonly\as_mut($this->prop); // convert to a non-readonly value
  }
}
```
