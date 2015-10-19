# Type Constants

Imagine that you have a non-generic class, and some various `extends` to that class. 

@@ type-constants/non-parameterized.php @@

Now imagine that you realize that sometimes the ID of a user could be a `string` as well as an `int`. But you know that the concrete classes of `User` will know exactly what type will be returned.

[Generics](../generics/intro.md) introduces the notion of type parameters which basically allows you to associate a type placeholder to a class or method, which is then fully associated once the class is instantiated or the method is called.

@@ type-constants/generics.php @@

Notice how we had to propagate the addition of a type parameter to the the class itself and *all* the extended it. Now think if we had hundreds and hundreds of places that used the traits and interfaces; we would have to update them as well.

When it comes to class type parameterization, Hack introduces an alternative feature to generics called *type constants*. Instead of types being declared as parameters directly on the class itself, type constants allow the type to be declared as class member properties instead.

@@ type-constants/type-constants.php @@

Notice the syntax `abstract const type <name> [ as <constraint> ];`. All type constants are `const` and use the keyword `type`. You specify a name for the constant, along with any possible constraints that must be adhered to. See [below](#syntax) for information about syntax.

Notice too that only the class itself and direct children needed to be updated with the new type information.

## Syntax

The syntax for a type constant depends on whether you are in an abstract or concrete class.

### Abstract class

In an abstract class, the syntax is the most straightforward:

```
abstract const type <name> [as <constraint>]; // constraint optional
```

For example:

```
class A {
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

You can declare a type constant in a concrete class, but it requires a special type of syntax:

```
const type <name> as mixed = mixed;
```

Basically you are declaring that the type constant can be pretty much any type. And in any child class, if no type constraint is specified, then `mixed` will be the default.

For example:

```
class NA {
  const type Foo as mixed = mixed;
}

class C1 extends NA {
  const type Foo = int;
}

class C2 extends NA {
  const type Foo; // defaults to mixed
}
```

### Referencing the Type Constant

Given that the type constant is a first-class property of the class, you can reference it using `this`, like the normal way you would reference a static property.

```
this::<name>
```

e.g.,

```
this::T;
```
