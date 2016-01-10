Imagine that you have a non-generic class, and some various `extends` to that class.

@@ introduction-examples/non-parameterized.php @@

Now imagine that you realize that sometimes the ID of a user could be a `string` as well as an `int`. But you know that the concrete classes of `User` will know exactly what type will be returned.

[Generics](../generics/introduction.md) introduces the notion of type parameters which basically allows you to associate a type placeholder to a class or method, which is then fully associated once the class is instantiated or the method is called.

@@ introduction-examples/generics.php @@

Notice how we had to propagate the addition of a type parameter to the the class itself and *all* that extended it. Now think if we had hundreds and hundreds of places that used the traits and interfaces; we would have to update them as well.

When it comes to class type parameterization, Hack introduces an alternative feature to generics called *type constants*. Instead of types being declared as parameters directly on the class itself, type constants allow the type to be declared as class member constants instead.

@@ introduction-examples/type-constants.php @@

Notice the syntax `abstract const type <name> [ as <constraint> ];`. All type constants are `const` and use the keyword `type`. You specify a name for the constant, along with any possible [constraints](/hack/type-constants/constraints) that must be adhered to. See [below](#syntax) for information about syntax.

Notice too that only the class itself and direct children needed to be updated with the new type information.

Type constants are a bit analogous to [abstract methods](http://php.net/manual/en/language.oop5.abstract.php), where base classes define method signatures without bodies, and subclasses provide the actual implementations.

## Syntax

The syntax for a type constant depends on whether you are in an abstract or concrete class.

### Abstract class

In an abstract class, the syntax is the most straightforward:

```
abstract const type <name> [as <constraint>]; // constraint optional
```

For example:

```
abstract class A {
  abstract const type Foo;
  abstract const type Bar as arraykey;
}
```

Then in concrete children of that subclass:

```
class C extends A {
  const type Foo = string;
  // Has to be int or string since was constrained to arraykey
  const type Bar = int;
}
```

### Concrete class

You can declare a type constant in a concrete class, but it requires different syntax:

```
const type <name> [as <constraint>] = <type>; // constraint optional
```

For example:

```
class NoChild {
  const type Foo = ?string;
}

class Parent {
  const type Foo as arraykey = arraykey; // need constraint for child override
}

class Child extends Parent {
  const type Foo = string; // a string is an arraykey, so ok
}
```

### Referencing the Type Constant

Given that the type constant is a first-class constant of the class, you can reference it using `this`, like the normal way you would reference a static constant.

```
this::<name>
```

e.g.,

```
this::T
```
