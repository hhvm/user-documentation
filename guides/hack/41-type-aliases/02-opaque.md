An *opaque type alias* is created using `newtype`. Unlike with [transparent type aliases](./transparent.md), with care in organizing source code, the compiler can make sure that general-purpose code cannot access an opaque alias's underlying type directly.

## Aliases without Type Constraints

Each opaque alias type is distinct from its underlying type and from any other types aliasing it or its underlying type. Only source code in the file that contains the definition of the opaque type alias is allowed access to the underlying implementation. 

Consider a file, `point.inc.php`, that contains an opaque alias definition for a 2D point type and a number of function primitives:

@@ opaque-examples/point.inc.php @@

Only those functions that need to know `Point`'s underlying structure should be defined in the above `Point` implementation file. All general-purpose functions that support the `Point` type can reside in something like PointFunctions.php, as shown below:

@@ opaque-examples/point-functions.inc.php @@

Here then is some code that creates and uses some Points:

@@ opaque-examples/test-point.php.type-errors @@

Being in the same file as the alias definition, function `createPoint` and friends have---and need---direct access to the integer fields in any Point's tuple. However, any other file does not.

## Aliases with Type Constraints

Consider a file that contains the following opaque type definition:

```
<?hh
newtype Counter = int;
```

Any file that includes this file has no knowledge that a `Counter` is really an integer, so that the including file cannot perform any integer-like operations on that type. This is a major limitation, as the supposedly well-chosen name for the abstract type, `Counter`, suggests that its value could increase and/or decrease. We can "fix" this by adding a type constraint to the alias's definition, as follows:

```
<?hh
newtype Counter as int = int;
```

The presence of the type constraint allows the opaque type to be treated as if it had the type specified by the type constraint, which removes some of the alias' opaqueness. Although the presence of a constraint allows the alias type to be converted implicitly to the constraint type, no conversion is defined in the opposite direction. In this example, this means that a `Counter` may be implicitly converted into an `int`, but not the other way around. The following example would fail to typecheck for this reason:

```
<?hh
// Assume this code is in a different file than where the Counter type is
// defined.
class A {
  public Counter $c;

  public function __construct() {
    // This is prohibited, as there is no implicit conversion from int 
    // (the type of 0) to Counter   
    $this->c = 0;
  }
} 
```

A type constraint must be a subtype of the type being aliased.

In the example below, `Point` has a constraint of `(int, int)`; thus we can pass a `Point` to any method expecting a `(int, int)` ... but not vice-versa!

@@ opaque-examples/point-constraint.inc.php @@
@@ opaque-examples/point-functions-constraint.inc.php @@
@@ opaque-examples/test-point-constraint.php @@

The two examples above motivate several of the use cases for poking a hole in opaque type aliases like this.

In the `Counter` example, we may have extra restrictions on the value of a `Counter` and how it is maintained, and so need the opacity to ensure the proper invariants are respected. This means we can't let just any `int` be a `Counter`. But going the other way is just fine; doing math on a `Counter` makes sense.

For the `Point` example, it may look like we are largely breaking the abstraction of the `Point`, and in fact we are. You probably wouldn't want to write new code that looks like this. However, it can be extremely useful when converting existing, untyped code. We can introduce a new `Point` opaque alias, but with a type constraint for backwards compatibility. Any new code will use the `Point` type, and thus be subject to the `Point` abstraction and its invariants. Existing code can continue to work on an `(int, int)` tuple directly, if it needs to. But that code can't convert back to a `Point` without going through the abstraction again, so the abstraction cannot be broken. Once all code is converted over, the constraint on the alias can be removed, and it can be fully opaque.
