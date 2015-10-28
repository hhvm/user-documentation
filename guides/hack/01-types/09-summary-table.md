# Type Summary Table

The following table summarizes the type system available in Hack, examples of how they are used in annotations, where they can be annotated (function, class method, class property, function/method return, parameter), and if they can be nullable. Remember, a return type is always preceded by a `:`.

Type       |    Example Annotations  |Func?|Meth?|Prop?|Ret?|Param?|Nullable?
-----------|-------------------------|-----|---- |-----|----|------|---------
Primitive  |`int`, `array`           | y   |  y  | y   | y  | y    | y
`num`      |`num`                    | y   |  y  | y   | y  | y    | y
`arraykey` |`arraykey`               | y   |  y  | y   | y  | y    | y
`void`     |`void`                   | y   |  y  | **x**   | **x**  | **x**    | **x**
`noreturn` |`noreturn`               | y   |  y\*| **x**   | **x**  | **x**    | **x**
Object     |`Foo`, `IBar`            | y   |  y  | y   | y  | y    | y
`mixed`    |`mixed`                  | y   |  y  | y   | y  | y    | **x**
`this`     |`this`                   | **x**   |  y  | **x**   | y  | **x**    | y 
XHP        |`XHPRoot`, `XHPChild`    | y   |  y  | y   | y  | y    | y
Nullable   |`?int`, `?Vector<string>`| y   |  y  | y   | y  | y    | y
Generics   |`Box<T>`, `Map<string, int>`| y   |  y  | y   | y  | y    | y
Enum       |`MyEnum`                 | y   |  y  | y   | y  | y    | y
Callable   |`(function(int, string): string)`|y |  y  | y   | y  | y    | y
Tuple      |`(int, string)`          | y   |  y  | y   | y  | y    | y
Type Alias |`MyAlias`                | y   |  y  | y   | y  | y    | y
Shape      |`MyShape`                | y   |  y  | y   | y  | y    | y

\* Only static methods
