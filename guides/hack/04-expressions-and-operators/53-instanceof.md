**The use of `instanceof` has been deprecated; use operator [`is`](is.md) instead.**

Operator `instanceof` determines if the variable designated by its left-hand operand is an object having the type specified by the right-hand 
one.  It returns a `bool` result.  For example:

```Hack
class C1 { ... }
class C2 { ... }
class D extends C1 { ... }
$d = new D();
$d instanceof C1      // true
$d instanceof C2      // false
$d instanceof D       // true
```

Variable `$d` has type `D`, and, by definition, every `D` is a `C1`, so `$d` is an instance of type `C1`. And clearly, it is an instance of 
its own type, `D`. However, it is not an instance of the completely unrelated type `C2`.

`instanceof` works equally well with interface types.  For example:

```Hack
interface I1 { ... }
interface I2 { ... }
class E1 implements I1 { ... }
$e1 = new E1();
$e1 instanceof I1     // true
$e1 instanceof I2     // false
```
