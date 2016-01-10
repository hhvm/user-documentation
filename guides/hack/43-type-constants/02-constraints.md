Constraints on type constants are similar to [constraints on generic type parameters](/hack/generics/constraints) in that they restrict what the type constant may be overridden by.

## Abstract Classes

A constraint on an abstract type constant requires that any class overrding the abstract type constant **must** be a subtype of the constraint type.

@@ constraints-examples/abstract.php.type-errors @@

## Concrete Classes

A concrete class type constant **must** have a constraint in order for any children to override that type constant.

@@ constraints-examples/concrete.php.type-errors @@
