A function that never returns a value can be annotated with the
`noreturn` type. A `noreturn` function either loops forever, throws an
an error, or calls another `noreturn` function.

``` Hack
function something_went_wrong(): noreturn {
  throw new Exception('something went wrong');
}
```

`invariant_violation` is an example of a library function with a `noreturn` type.

`noreturn` informs the typesystem that code execution can not continue past a certain line.
In combination with a conditional, you can refine variables, since the typesystem will take note.
This is actually how [invariant](../expressions-and-operators/invariant) is [implemented](/hack/reference/function/HH.invariant).

@@ noreturn-examples/refinement.php @@

If you want to, you can also use [nothing](./nothing) instead. This allows you use the return value of the function.
This makes it more explicit to the reader of your code that you are depending on the fact that this function influences typechecking.

@@ noreturn-examples/noreturn-vs-nothing.php @@

In this example the `noreturn` function is named very plain, so you can understand that this refines.
However in the `nothing` version you don't need to know the signature of `i_return_nothing()`
to understand that `$nullable_int` will not be null after the if, since you can see the `return`.
