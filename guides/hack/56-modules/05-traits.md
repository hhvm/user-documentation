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
Since public traits by nature can have their implementations copied to any class in any other module, they leak internal implementations to the public. Therefore, public traits cannot access any internal symbols or implementations from the module they are defined in. You can think of public traits as not belonging to any specific module, even if they are defined within one. 

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
Public traits also cannot have internal methods or properties, as they may be used by classes outside of any module. 

```hack

public trait TBar {
    internal function foo(): void {} // error, public traits cannot have internal methods or properties
}
```
