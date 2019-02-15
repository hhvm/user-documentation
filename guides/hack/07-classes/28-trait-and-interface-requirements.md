Trait and interface requirements allow you to restrict the use of these constructs by specifying what classes may actually use a trait or 
implement an interface. This can simplify long lists of `abstract` method requirements, and provide a hint to the reader as to the 
intended use of the trait or interface.

## Syntax

To introduce a trait requirement, you can have one or more of the following in your trait:

```Hack
require extends <class name>;
require implements <interface name>;
```

To introduce an interface requirement, you can have one or more of following in your interface:

```Hack
require extends <class name>;
```

## Traits

Here is an example of a trait that introduces a class and interface requirement, and shows a class that meets the requirement:

@@ trait-and-interface-requirements-examples/trait-good.php @@

Here is an example of a trait that introduces a class and interface requirement, and shows a class that *does not* meet the requirement:

@@ trait-and-interface-requirements-examples/trait-bad.php.type-errors @@

**NOTE**: `require extends` should be taken literally. The class *must* extend the required class; thus the actual required class 
**does not** meet that requirement. This is to avoid some subtle circular dependencies when checking requirements.

## Interfaces

Here is an example of an interface that introduces a class requirement, and shows a class that meets the requirement:

@@ trait-and-interface-requirements-examples/interface-good.php @@

Here is an example of an interface that introduces a class requirement, and shows a class that *does not* meet the requirement:

@@ trait-and-interface-requirements-examples/interface-bad.php.type-errors @@

