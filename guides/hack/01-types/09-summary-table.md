# Type Summary Table

The following table summarizes the type system available in Hack, examples of how they are used in annotations, where they can be annotated (function, class method, class property, function/method return, parameter), and if they can be nullable. Remember, a return type is always preceded by a `:`.

Type       |    Example Annotations  |Func?|Meth?|Prop?|Ret?|Param?|Nullable?
-----------|-------------------------|-----|---- |-----|----|------|---------
Primitive  |`int`, `array`           | &#x2713;   |  &#x2713;  | &#x2713;   | &#x2713;  | &#x2713;    | &#x2713;
`num`      |`num`                    | &#x2713;   |  &#x2713;  | &#x2713;   | &#x2713;  | &#x2713;    | &#x2713;
`arraykey` |`arraykey`               | &#x2713;   |  &#x2713;  | &#x2713;   | &#x2713;  | &#x2713;    | &#x2713;
`void`     |`void`                   | &#x2713;   |  &#x2713;  | &#x2717;   | &#x2717;  | &#x2717;    | &#x2717;
`noreturn` |`noreturn`               | &#x2713;   |  &#x2713;\*| &#x2717;   | &#x2717;  | &#x2717;    | &#x2717;
Object     |`Foo`, `IBar`            | &#x2713;   |  &#x2713;  | &#x2713;   | &#x2713;  | &#x2713;    | &#x2713;
`mixed`    |`mixed`                  | &#x2713;   |  &#x2713;  | &#x2713;   | &#x2713;  | &#x2713;    | &#x2717;
`this`     |`this`                   | &#x2717;   |  &#x2713;  | &#x2717;   | &#x2713;  | &#x2717;    | &#x2713; 
XHP        |`XHPRoot`, `XHPChild`    | &#x2713;   |  &#x2713;  | &#x2713;   | &#x2713;  | &#x2713;    | &#x2713;
Nullable   |`?int`, `?Vector<string>`| &#x2713;   |  &#x2713;  | &#x2713;   | &#x2713;  | &#x2713;    | &#x2713;
Generics   |`Box<T>`, `Map<string, int>`| &#x2713;   |  &#x2713;  | &#x2713;   | &#x2713;  | &#x2713;    | &#x2713;
Enum       |`MyEnum`                 | &#x2713;   |  &#x2713;  | &#x2713;   | &#x2713;  | &#x2713;    | &#x2713;
Callable   |`(function(int, string): string)`|&#x2713; |  &#x2713;  | &#x2713;   | &#x2713;  | &#x2713;    | &#x2713;
Tuple      |`(int, string)`          | &#x2713;   |  &#x2713;  | &#x2713;   | &#x2713;  | &#x2713;    | &#x2713;
Type Alias |`MyAlias`                | &#x2713;   |  &#x2713;  | &#x2713;   | &#x2713;  | &#x2713;    | &#x2713;
Shape      |`MyShape`                | &#x2713;   |  &#x2713;  | &#x2713;   | &#x2713;  | &#x2713;    | &#x2713;

\* Only static methods
