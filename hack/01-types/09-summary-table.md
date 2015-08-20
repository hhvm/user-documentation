The following table summarizes the type system available in Hack, examples of how they are used in annotations, where they can be annotated (function, class method, class property, function/method return, parameter), and if they can be nullable. Remember, a return type is always preceded by a `:`.

Type       |    Example Annotations  |Func?|Meth?|Prop?|Ret?|Param?|Nullable?
-----------|-------------------------|-----|---- |-----|----|------|---------
Primitive  |`int`, `array`           | ✓   |  ✓  | ✓   | ✓  | ✓    | ✓
`num`      |`num`                    | ✓   |  ✓  | ✓   | ✓  | ✓    | ✓
`arraykey` |`arraykey`               | ✓   |  ✓  | ✓   | ✓  | ✓    | ✓
`void`     |`void`                   | ✓   |  ✓  | x   | x  | x    | x
`noreturn` |`noreturn`               | ✓   |  ✓\*| x   | x  | x    | x
Object     |`Foo`, `IBar`            | ✓   |  ✓  | ✓   | ✓  | ✓    | ✓
`mixed`    |`mixed`                  | ✓   |  ✓  | ✓   | ✓  | ✓    | x
`this`     |`this`                   | x   |  ✓  | x   | ✓  | x    | ✓ 
XHP        |`XHPRoot`, `XHPChild`    | ✓   |  ✓  | ✓   | ✓  | ✓    | ✓
Nullable   |`?int`, `?Vector<string>`| ✓   |  ✓  | ✓   | ✓  | ✓    | ✓
Generics   |`Box<T>`, `Map<string, int>`| ✓   |  ✓  | ✓   | ✓  | ✓    | ✓
Enum       |`MyEnum`                 | ✓   |  ✓  | ✓   | ✓  | ✓    | ✓
Callable   |`(function(int, string): string)`|✓ |  ✓  | ✓   | ✓  | ✓    | ✓
Tuple      |`(int, string)`          | ✓   |  ✓  | ✓   | ✓  | ✓    | ✓
Type Alias |`MyAlias`                | ✓   |  ✓  | ✓   | ✓  | ✓    | ✓
Shape      |`MyShape`                | ✓   |  ✓  | ✓   | ✓  | ✓    | ✓

\* Only static methods
