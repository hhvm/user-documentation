**This type is intended to help with code being transitioned from untyped mode to strict 
mode. It might also be useful as a replacement for [mixed](../mixed.md).  In any 
event `dynamic` should not be used in new code.**

Although `dynamic` can be used as the type of a class constant or property, or a function 
return type, its primary use is as a parameter type. 

This special type is used to help capture dynamism in the existing codebase in typed code, in 
a more manageable manner than `mixed`. With `dynamic`, the presence of dynamism in a function 
is local to the function, and dynamic behaviors cannot leak into code that does not know about it.

Consider the following:
```Hack

function f(dynamic $x) : void {
  $y = $x + 5;            // $y is a num
  $y = $x . "hello!";     // $y is a string 
  $y = $x->anyMethod();   // $y is dynamic
}
```

A value of type `dynamic` can be used in most local operations: like untyped expressions, we 
can treat it like an integer and add it, or a string and concatenate it, or call any method on it, as shown above.

When using a dynamic type in an operation, the type checker infers the best possible type with 
the information it has. For example, using a dynamic in an arithmetic operation like + or - result 
in a `num`, using a dynamic in a string operation result in a `string`, but calling a method on a 
dynamic, results in another dynamic.

In the type hierarchy, `dynamic` is a supertype of all types. If a function accepts or returns a 
dynamic type, any value can be used without performing a cast.

`dynamic` is permissive locally, so we don’t have to null-check it. That said, this means there 
are no guarantees by the type checker that our type is actually `nonnull`.

Unlike untyped expressions, `dynamic` is not a subtype of any regular type. That is, we cannot pass 
it to a function that expects a non-dynamic type, or return it from a function that returns a 
non-dynamic type (besides mixed) without casting.

