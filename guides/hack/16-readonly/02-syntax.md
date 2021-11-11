The `readonly` keyword can be applied to various positions in Hack.

## Parameters and return values
Parameters and return values of any callable can be marked `readonly`.

``` Hack
function foo(readonly Foo $x): readonly Bar {
  return $x->bar;
}
```

A readonly *parameter* signals that the function/method will not modify that parameter; a readonly *return type* signals that the function returns a readonly reference to an object that can not be modified.

## Static and regular properties
Static and regular properties can be marked `readonly` and, when applied, can not be modified.

``` Hack
class Foo {
  private readonly Bar $bar;
  private static readonly Bar $static_bar;
}
```
A readonly property represents a property that holds a readonly reference(specifically, that the nested object within the property cannot be modified).


## Lambdas and function type signatures
`readonly` is allowed on inner parameters and return types on function typehints.

``` Hack
function call(
    (function(readonly Bar) : readonly Bar) $f,
    readonly Bar $arg,
   ) : readonly Bar {
   return $f($arg);
}
```

## Expressions
`readonly` can appear on expressions to convert mutable values to readonly. 
``` Hack
function foo(): void {
  $x = new Foo();
  $y = readonly $x;
}
```

## Functions / Methods
`readonly` can appear as a modifier on instance methods, signaling that `$this` is readonly (i.e, that the method promises not to modify the instance). 

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

Note that readonly objects can only call readonly methods, since they promise not to modify the object.

``` Hack
class Data {}
class Box {
  public function __construct(public Data $data)
  public readonly function getData(): readonly Data {
    return $this->data;
  }
  public function setData(Data $d) : void {
    $this->data = $d;
  }
}

function readonly_method_example(readonly Box $b): void {
  $y = readonly $b->getData(); // ok, $y is readonly
  $b->setData(new Data()); // error, $b is readonly, it can only call readonly methods
}
```

## Closures and function types
A function type can be marked readonly: `(readonly function(T1): T)`. Denoting a function/closure as readonly adds the restriction that the function/closure captures all values as readonly:

``` Hack
function readonly_closure_example(): void {
  $x = new Foo();
  $f = readonly () ==> {
    $x->prop = 4; // error, $x is readonly here!
  };
}
```
One way to make sense of this behavior is to think of closures as objects with an __invoke function (which is how HHVM implements all closures), and whose properties are the values it captures. A readonly closure is then defined as a closure whose __invoke function is annotated with readonly.

Readonly closures affect Hack’s type system, where readonly closures are subtypes of their mutable counterparts. Specifically, a (readonly function(T1):T2) is a strict subtype of a (function(T1): T2).


