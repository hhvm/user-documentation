# Internal and module level visibility
One goal of using modules is to separate a code unit's public and private interfaces. If a file is part of a module, its toplevel functions, classes, interfaces, traits, enums, and typedefs can be marked `internal`. An internal toplevel symbol cannot be referenced outside of its module. If a symbol is not internal, it is `public`, and it's part of the public API of the module. You can optionally use the `public` keyword on toplevel symbols to denote them as public. 

```hack
module foo;
internal class Foo {}
internal trait TFoo {}
internal interface IFoo {}
internal newtype TInternal = Foo;
```

```hack
module bar;
// error: Foo is internal, it cannot be referenced outside of its module
public function foo(): Foo {
}
```

Methods and properties within classes also gain a new visibility `internal`, which means that they can only be accessed or called within the module.
```hack
module foo;
public class Foo {
    internal function foo(): void {
        echo "foo!\n";
    }
    internal int $prop = 5;
    public function bar(): void {
        echo "bar!\n";
    }
}
```

An internal method or property can be called anywhere from within a module. `internal` replaces the visibility keyword of the method or propertiy (i.e. `protected`, `public` or `private`). Note that **class members' visibilities do not have to match the visibility of the class itself**: an internal class can have public methods, and a public class can have internal methods. You can think of the visibility on a toplevel symbol to represent where a symbol is allowed to be denoted, whereas the visibility of a method or property to represent where that individual member can be accessed. 

If you try calling an internal method or accessing a property from outside of the module, you'll get a runtime error. 

```hack
module bar;
<<__EntryPoint>>
function test(): void {
    $x = new Foo(); // ok since Foo is a public class
    $x->bar(); // prints "bar!"
    $x->foo(); // error, foo is an internal method being called from outside the module.
    $x->prop = 5; // error, $x::prop is an internal property being accessed outside of the module.
}
```

We will go over the inheritance and override rules in a different section.


### Referencing internal symbols in your public API
Public symbols within your module generally cannot reference internal symbols directly. 

```hack
module foo;
internal class Secret {
    internal function mySecret(): int {
        return 42;
    }
}
public function foo(): Secret { // error, public API users wouldn't know what a Secret is
    return new Secret();
}
```

In order to expose Secret to outside users, you can use a public interface. 
```hack
module foo;
public interface Public { 
    public function myPublic(): int;
}
internal class Secret implements Public { 
    public function myPublic(): int {
        return $this->mySecret();
    }
    internal function mySecret(): int {
        return 42;
    }
}
public function foo(): Public { // 
    return new Secret();
}
```
At runtime, if code from another module calls `foo`, it will receive a Secret object. However, statically, any function that calls foo must respect the defined Public interface.

```hack
module bar;
<<__EntryPoint>>
public function test(): void {
    $x = foo(); // $x has type Secret at runtime
    $x->myPublic(); // returns 42
    $x->mySecret(); // typechecker error, $x is type Public, it does not have a method called mySecret().
}
```

