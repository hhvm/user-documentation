[Traits](http://php.net/manual/en/language.oop5.traits.php) provide a method of code reuse. A trait can define properties and methods, and those definitions can refer to properties and methods that the enclosing class must define. The reliance on what the enclosing class is often implicit, or specified through a cumbersome series of `abstract` method requirements.

[Interfaces](http://php.net/manual/en/language.oop5.interfaces.php) provide a way to encapsulate common operations that will be implemented by classes that implement the interface.

Trait and interface requirements allow you to restrict the use of these constructs by specifying what classes may actually use a trait or implement an interface. This can simplify a long list of `abstract` method requirements, and provide a hint to the reader as to the intended use of the trait or interface.

## Syntax

To introduce a trait requirement, you can have one or more of these in your trait:

```
require extends <class name>;
require implements <interface name>;
```

To introduce an interface requirement, you can have one or more of these in your interface:

```
require extends <class name>;
```

## Traits

Here is an example of a trait introducing a class and interface requirement and shows a class that meets the requirement.

@@ trait-and-interface-requirements-examples/trait-good.php @@

Here is an example of a trait introducing a class and interface requirement and shows a class that *does not* meet the requirement.

@@ trait-and-interface-requirements-examples/trait-bad.php.type-errors @@

**NOTE**: `require extends` should be taken literally. The class must extend the required class; thus the actual required class **does not** meet that requirement. This is to avoid some subtle circular dependencies when checking requirements.

## Interfaces

Here is an example of an interface introducing a class requirement and shows a class that meets the requirement.

@@ trait-and-interface-requirements-examples/interface-good.php @@

Here is an example of an interface introducing a class requirement and shows a class that *does not* meet the requirement.

@@ trait-and-interface-requirements-examples/interface-bad.php.type-errors @@
