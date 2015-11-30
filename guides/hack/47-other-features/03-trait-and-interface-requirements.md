[Traits](http://php.net/manual/en/language.oop5.traits.php) provide a method of code reuse. A trait is essentially a piece of code that describes properties and methods that it doesn't actually define. The classes that use the trait define them.

[Interfaces](http://php.net/manual/en/language.oop5.interfaces.php) provide a way to encapsulate common operations that will be implemented by classes that implement the interface.

Trait and interface requirements allow you to restrict the use of these constructs by specifying what classes may actually use a trait or implement an interface.

## Syntax

To force a trait requirement, you can have one or more of these in your trait:

```
require extends <class name>;
require implements <interface name>;
```

To force an interface requirement, you can have one or more of these in your interface:

```
require extends <class name>;
```

## Traits

Here is an example of a trait forcing a class and interface requirement and shows a class that meets the requirement and a class that does not.

@@ trait-and-interface-requirements-examples/trait.php.type-errors @@

**NOTE**: `require extends` should be taken literally. The class must extend
the required class; thus the actual required class **does not** meet that requirement.

## Interfaces

Here is an example of an interface forcing a class requirement and shows a class that meets the requirement and a class that does not.

@@ trait-and-interface-requirements-examples/interface.php.type-errors @@
