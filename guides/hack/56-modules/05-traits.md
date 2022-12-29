Traits have special behavior in Hack when used with modules. 

## Marking traits internal 
An internal trait can only be used within the module it's defined. Internal traits can have public, protected, or internal methods. 

```hack
module foo;
internal trait TFoo {
    public function foo(): void {}
    internal function bar(): void {}
}
```

```hack
module bar;
public class Bar {
    use TFoo; // error, TFoo is internal
}
```



## Public traits
Since public traits have "copy-paste" behavior in that their implementations can be copied to any other module, these traits must be treated as if they are outside of any module for safety. Therefore, public traits cannot access any internal symbols or implementations from the module they are defined in. 

```hack
module foo;
internal class Foo {}
// Assume TFoo is defined as before
public trait TBar {
    use TFoo; // error, TBar is a public trait, it cannot access internal symbols in module foo
    public function foo(): mixed {
        return new Foo(); // error, TBar is a public trait, it cannot access internal symbols in module foo
    }
}
```
Public traits also cannot have internal members, as they may be used by classes outside of any module. 

```hack

public trait TBar {
    internal function foo(): void {} // error, public traits cannot have internal members
}
```
