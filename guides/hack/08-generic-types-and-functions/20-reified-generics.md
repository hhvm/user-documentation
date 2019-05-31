# Reified Generics

## How to enable

The feature is turned on by default in HHVM and setting `enable_experimental_tc_features = reified_generics` will turn the feature on for the typechecker. This feature is currently experimental and subject to change.

## Introduction

Generics are currently implemented in HHVM through erasure, in which the runtime drops all information about generics. This means that generics are not available at runtime. Although the typechecker is able to use the generic types for static typechecking, we are unable to enforce generic types at runtime.

The goal of opt-in reified generics to bridge the gap between generics and runtime availability while keeping erasure available to maintain performance when reification is not needed. To mark a generic as reified, simply add the `reify` keyword at the declaration site.

## Parameter and return type verification

@@ reified-generics-examples/type-verification.php.type_errors @@

The reified type parameter is checked as well:

@@ reified-generics-examples/type-verification-2.php.type_errors @@

## Type testing and assertion with `is` and `as` expressions

Suppose you have a `vec<mixed>` and you want to extract all types `T` from it. Prior to reified generics, you'd need to implement a new function for each type `T` but with reified generics you can do this in a generic way. Start by adding the keyword `reify` to the type parameter list.

@@ reified-generics-examples/type-testing.php @@

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

@@ reified-generics-examples/new-reify.php.type_errors @@

Notice that the reified type parameter has the attribute `<<__Newable>>`. In order for a type to be `<<__Newable>>`, the type must represent a class that's not abstract and has a consistent constructor or be a final class. Creating a new instance using the reified generics also carries across the generics given. For example,

```Hack
final class A<reify T> {}

function f<<<__Newable>> reify T as A<string>>(): A<string> {
  return new T();
}

// creates a new A<int> and since f's return type is A<string>,
// this raises a type hint violation
f<A<int>>();
```

## Accessing a class constant / static class property / static class method

@@ reified-generics-examples/access.php @@

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
function f<<<__Enforceable>> reify T>(): void {
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

