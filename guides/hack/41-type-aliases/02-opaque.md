# Opaque Type Aliases

An *opaque type alias* is created using `newtype`. Unlike with [transparent type aliases](./transparent.md), with care in organizing source code, the compiler can make sure that general-purpose code cannot access an opaque alias's underlying type directly.

## Aliases without Type Constraints

Each opaque alias type is distinct from its underlying type and from any other types aliasing it or its underlying type. Only source code in the file that contains the definition of the opaque type alias is allowed access to the underlying implementation. 

Consider a file, `point.inc.php`, that contains an opaque alias definition for a 2D point type and a number of function primitives:

@@ opaque-examples/point.inc.php @@

Only those functions that need to know `Point`'s underlying structure should be defined in the Point implementation file. All general-purpose functions that support the `Point` type can reside in something like PointFunctions.php, as shown below:

@@ opaque-examples/point-functions.inc.php @@

Here then is some code that creates and uses some Points:

@@ opaque-examples/test-point.php.type-errors @@

Being in the same file as the alias definition, function `createPoint` and friends have---and need---direct access to the integer fields in any Point's tuple. However, any file that includes this file does not.

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

The presence of the type constraint allows the opaque type to be treated as if it had the type specified by the type constraint, which removes some of the alias' opaqueness. Note, that although the presence of a constraint allows the alias type to be converted implicitly to the constraint type, no conversion is defined in the opposite direction. Specifically, the following is prohibited:

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

The lesson here is to not get carried away inventing your own custom-name set of types, just for the sake of being cute!

A type constraint must be a subtype of the type being aliased.

In the example below, `Point` has a constraint of `(int, int)`; thus we can pass a `Point` to any method expecting a `(int, int)` ... but not vice-versa!

@@ opaque-examples/point-constraint.inc.php @@
@@ opaque-examples/point-functions-constraint.inc.php @@
@@ opaque-examples/test-point-constraint.php @@
