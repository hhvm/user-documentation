Names are used to label variables, constants, functions, and user-defined types, among other things. A name *must* begin
with an upper- or lowercase letter or underscore, which can optionally be followed by those same characters or decimal digits.

Local variable names, function parameter names and property names *must* be preceded by `$`. For example:

```various-names.hack no-auto-output
class Data {
  const int MAX_VALUE = 100;
  private int $value = 0;
  /* ... */
}
interface ICollection { /* ... */ }
enum Position: int {
  Top = 0;
  Bottom = 1;
  Left = 2;
  Right = 3;
  Center = 4;
}
function compute(int $val): void {
  $count = $val + 1;
  /* ... */
}
```

## The Placeholder Variable
The name `$_`, referred to as the *placeholder variable*, is reserved for use in the
[list intrinsic function](../expressions-and-operators/list.md) and the [foreach statement](../statements/foreach.md).

## The Current Instance Variable
The name `$this` is predefined inside any instance method or constructor when that method is called from within an object context.
`$this` is read-only and designates the object on which the method is being called, or the object being constructed. The type of
`$this` is [`this`](../built-in-types/this.md).

## Reserved Names
Names beginning with two underscores (__) are reserved by the Hack language.

## XHP Name Constraints
Note that [XHP classes](../XHP/introduction) have different name
constraints. Class names may contain `:`, and must start with
`:`. [XHP categories](../XHP/extending#children__categories) names
start with `%`.
