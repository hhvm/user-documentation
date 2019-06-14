For the most part, we deal with class types directly via their names.  For example:

```Hack
class Employee { ... }
$emp = new Employee( ... );
```

However, in some applications, it is useful to be able to abstract a class's name rather than to hard-code it.  Consider the following:

```Hack
class Employee { ... }
function f(classname<Employee> $clsname): void {
  $w = new $clsname(); // allocate memory for an object whose type is passed in
  ...
}
```

For this to work, we need a type that can represent a class name, and that is the type `classname<`...`>`.

Consider the following:

```Hack
class C1 { ... }
class C2 {
  public static classname<C1> $p1 = C1::class;
  public static function f(?classname<C1> $p): classname<C1> { ... }
  public static vec<classname<C1>> $p2 = vec[C1::class];}
```

Here, class `C2` has three public members. The first is a property having a classname type, which is initialized using a special form of
the [scope-resolution operator, `::`](../expressions-and-operators/scope-resolution.md) ending in `class`.  The second is a function that
takes a nullable classname-typed argument, and returns a value of that classname type.  The third is a property whose type is a vec of one `classname<C1>`.

The value of an expression of a classname type can be converted implicitly or explicitly to type `string`.
