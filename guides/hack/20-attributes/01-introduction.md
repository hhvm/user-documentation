Attributes attach metadata to Hack definitions.

Hack provides built-in attributes that can change runtime or
typechecker behavior.

```Hack
<<__Memoize>>
function add_one(int $x): int {
  return $x + 1;
}
```

You can attach multiple attributes to a definition, and attributes can
have arguments.

``` Hack
<<__ConsistentConstruct>>
class OtherClass {
  <<__Memoize, __Deprecated("Use FooClass methods instead")>>
  public function addOne(int $x): int {
    return $x + 1;
  }
}
```

## Defining an attribute

You can define your own attribute by implementing an attribute
interface in the HH namespace.

``` Hack
class Maintainers implements HH\ClassAttribute {
  public function __construct(string ...$args) {}
}

<<Maintainers("Team X", "Team Y")>>
class MyClass {}
```

Other common attribute interfaces are `HH\FunctionAttribute`,
`HH\MethodAttribute` and `HH\PropertyAttribute`, but see [the Hack
interface reference](/hack/reference/interface/) for the full list.


## Accessing attribute arguments

You need to use reflection to access attribute arguments.

Given the `MyClass` example defined above:

``` Hack
$rc = new ReflectionClass('MyClass');
$rc->getAttribute('Maintainers') // ["Team X", "Team Y"]
```
