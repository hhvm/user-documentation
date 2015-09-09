There are three (and only three) places where types can be explicitly annotated in Hack:

- Function/method returns
- Parameters
- Class Properties

## Function and Method Returns

Function and method return types are annotated with a `:` following the name and parameter list of the function or method as follows:

```
function <name>([parameters]): <type>
function foo(): int {}
```

**NOTE**: You can have whitespace between the name/parameter list and the `:`.
**NOTE**: Closures can have return types annotated too

## Function and Method Parameters

Function and method parameters are annotated with the type before the parameter name as follows:

```
function <name>(<ptype> <$pname>): <rtype>
function foo(int $x): void {}
```

**NOTE**: Default arguments to a parameter must match the type annotation provided.

## Class Properties

Class properties are annotated with the type before the property name as follows:

```
<modifiers> <type> <$pname>;
public int $x;
```

### Abstract final classes

A class in Hack can be marked both `abstract` and `final`. This means the class can only have static methods and properties, and no constructor. A property is annotated with `static`, in addition to the data type.

```
abstrct final class X {
  public static array<int> $a = array();
}
```

### Abstract class constants

In addition to typing properties with their data type, you can also declare constants abstract in an abstract class

```
interface I {
  abstract const int MY_CONST;
}
```

## Local variables

You **DO NOT** type annotate local variables. They are [inferred](inference.md) by the typechecker automatically.
