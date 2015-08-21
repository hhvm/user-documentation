There are cases when the typechecker will report an error, but the program will run perfectly fine in HHVM.

@@ runtime-examples/type-error-but-runs.php @@

However, there is some support for runtime type checking in HHVM, but its enforcement is currently limited. 

- HHVM ignores property annotations.
- HHVM supports parameter and return type annotations; generally, if you violate the agreement, a catchable fatal error will be thrown. However there are exceptions:
-- `void` is not enforced at runtime; i.e., you can return a value from a `void` function at runtime
-- [Generics](../03-generics/01-intro.md) are enforced as if they did not have type parameters.
-- [Shapes](../08-shapes/01-intro.md) and [tuples](02-type-system.md#tuples) are only enforced as if they were an `array()`. The inner types of each are not enforced.
-- [Enums](../12-enums/01-intro.md) are enforced only at the underlying type level. HHVM does not check for valid enum values
-- If you specify the soft-type hint operator `@` before an annotation, a warning would be thrown in the case where a catchable fatal would have been.
