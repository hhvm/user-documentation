# Type Summary Table

The following table summarizes the type system available in Hack, examples of how they are used in annotations, where they can be annotated (function, class method, class property, function/method return, parameter), and if they can be nullable. Remember, a return type is always preceded by a `:`.

Type       |    Example Annotations  |Function|Class Method|Class Property|Function Return|Parameter|Nullable
-----------|-------------------------|-----|---- |-----|----|------|---------
Primitive  |`int`, `array`           | Yes   |  Yes  | Yes   | Yes  | Yes    | Yes
`num`      |`num`                    | Yes   |  Yes  | Yes   | Yes  | Yes    | Yes
`arraykey` |`arraykey`               | Yes   |  Yes  | Yes   | Yes  | Yes    | Yes
`void`     |`void`                   | Yes   |  Yes  | **No**   | **No**  | **No**    | **No**
`noreturn` |`noreturn`               | Yes   |  Yes\*| **No**   | **No**  | **No**    | **No**
Object     |`Foo`, `IBar`            | Yes   |  Yes  | Yes   | Yes  | Yes    | Yes
`mixed`    |`mixed`                  | Yes   |  Yes  | Yes   | Yes  | Yes    | **No**
`this`     |`this`                   | **No**   |  Yes  | **No**   | Yes  | **No**    | Yes 
XHP        |`XHPRoot`, `XHPChild`    | Yes   |  Yes  | Yes   | Yes  | Yes    | Yes
Nullable   |`?int`, `?Vector<string>`| Yes   |  Yes  | Yes   | Yes  | Yes    | Yes
Generics   |`Box<T>`, `Map<string, int>`| Yes   |  Yes  | Yes   | Yes  | Yes    | Yes
Enum       |`MyEnum`                 | Yes   |  Yes  | Yes   | Yes  | Yes    | Yes
Callable   |`(function(int, string): string)`|Yes |  Yes  | Yes   | Yes  | Yes    | Yes
Tuple      |`(int, string)`          | Yes   |  Yes  | Yes   | Yes  | Yes    | Yes
Type Alias |`MyAlias`                | Yes   |  Yes  | Yes   | Yes  | Yes    | Yes
Shape      |`MyShape`                | Yes   |  Yes  | Yes   | Yes  | Yes    | Yes

\* Only static methods
