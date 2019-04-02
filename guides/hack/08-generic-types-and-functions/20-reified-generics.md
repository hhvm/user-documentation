# Reified Generics

## Introduction

Generics are currently implemented in HHVM through erasure, in which the runtime drops all information about generics. This means that generics are not available at runtime. Although the typechecker is able to use the generic types for static typechecking, we are unable to enforce generic types at runtime.

The Hack Langugage is introducing opt-in reified generics to bridge the gap between generics and runtime availability while keeping erasure available to maintain performance when reification is not needed. To mark a generic as reified, simply add the `reify` keyword at the declaration site.

## Parameter and return type verification

Prior to reified generics, if the type hint for a parameter or return value had generics, HHVM would only check whether the input is of the outermost type (whether `$c` is a `C` in the next example). With reified generics, HHVM will also check and enforce the reified type parameters.

```Hack
class C<reify T> {}

function f(C<int> $c): void {}

$c1 = new C<int>();
f($c1); // success
$c2 = new C<string>();
f($c2); // parameter type hint violation
```

The reified type parameter is checked as well:

```Hack
class C<reify T> {}

function f<reify T>(T $x): C<T> {
  return new C<int>();
}

f<int>(1); // success
f<int>("yep"); // parameter type hint violation
f<string>("yep"); // return type hint violation
```

## Type testing and assertion with `is` & `as` expressions

Suppose you have a `vec<mixed>` and you want to extract all type `T` from it. Prior to reified generics, you'd need to implement a new function for each type `T` but with reified generics you can do this in a generic way. Start by adding the keyword `reify` to the type parameter list.

```Hack
function filter<<<__Enforceable>> reify T>(vec<mixed> $list): vec<T> {
  $ret = vec[];
  foreach ($list as $elem) {
    if ($x is T) {
      $ret[] = $elem;
    }
  }
  return $ret;
}

filter<int>(vec[1, "hi", true])
// => vec[1]
filter<string>(vec[1, "hi", true])
// => vec["hi"]
```

Notice that the reified type parameter has the attribute `<<__Enforceable>>`. In order to use type testing and type assertion, the reified type parameter must be marked as `<<__Enforceable>>`, which means that we can fully enforce this type parameter, i.e. it does not contain any erased generics, not a function type, etc.

```Hack
class A {}
class B<reify T> {}
class C<reify Ta, Tb> {}

int // enforceable
A // enforceable
B<int> // enforceable
B<A> // enforceable
C<int, string> // NOT enforceable as C's second generic is erased
```

## Creating an instance of a class with `new`

Prior to reified generics, in order to create a new instance of a class without a constant class name, you'd need to pass it as `classname<T>` which is not type safe. In the runtime, classnames are strings.

```Hack
<<__ConsistentConstruct>>
abstract class A {}

class B extends A {}
class C extends A {}

function f<<<__Newable>> reify T as A>(): T {
  return new T();
}

f<A>(); // not newable since it is abstract class
f<B>(); // success
f<C>(); // success
```

Notice that the reified type parameter has the attribute `<<__Newable>>`. In order for a type to be `<<__Newable>>`, the type must represent a class that's not abstract and has a consistent constructor or be a final class. Creating a new instance using the reified generics also carries across the generics given. For example,

```Hack
final class A<reify T> {}

function f<<<__Newable>> reify T as A<string>>(): T {
  return new T();
}

// creates a new A<int> and since f's return type is A<string>,
// this raises a type hint violation
f<A<int>>();
```

## Accessing a class constant / static class property / static class method

```Hack
class C {
  const string class_const = "hi";
  public static string $class_propery = "hi";
  public static function h<reify T>(): void {}
}

// Without reified generics
function f<T as C>(classname<T> $x): void {
  $x::class_const;
  $x::$class_propery;
  $x::h<int>();
}

// With reified generics
function g<reify T as C>(): void {
  T::class_const;
  T::$class_propery;
  T::h<int>();
}
```

## Hack Arrays

Hack Arrays can be used as inner type for classes since we do not need to check whether each element of the `vec` is `string`.
Look at the limitations section for more information on when Hack Arrays cannot be used.

```Hack
class Box<reify T> {}

function foo(): Box<vec<string>> {
  return new Box<vec<int>>(); // Type hint violation
}

foo(); 
```

# Limitations

* No support for subtyping (reified type parameter on classes are invariant, they cannot be co/contra-variant

```Hack
class C<reify +Ta> {} // Cannot make the generic covariant
```

* Static class methods cannot use the reified type parameter of its class

```Hack
class C<reify T> {
  public static function f(): void {
    return new T(); // Cannot use T
   }
}
```

* Hack arrays cannot be reified when used as containers with `__Enforceable` or `__Newable`

```Hack
function f<<<__Enforceable>> reify>(): void {
    $x is vec<int>; // Cannot use vec<int>
    $x is T;
}
f<vec<int>>(); // not enforceable
```

but can be used as inner type for classes

* If a type parameter is reified, it must be provided at all call sites; it cannot be inferred.

```Hack
function f<reify T>(): void {}

f(); // need to provide the generics here
```

# Migration Features

In order to make migrating to reified generics easier, we have added some [Migration Features](reified-generics-migration.md).

