A variadic function can take a variable number of arguments. In PHP, all functions are variadic, even if they don't explicitly say so. So a function that looks like:

```
function foo ($a, $b) {}
```

can actually be passed more than 2 arguments. You can access the passed arguments to a function, including the "extra" ones, via [`func_get_args`](http://php.net/manual/en/function.func-get-args.php), [`func_get_arg`](http://php.net/manual/en/function.func-get-arg.php) and [`func_num_args`](http://php.net/manual/en/function.func-num-args.php).

In Hack, however, you cannot pass more arguments than are specified. A typechecker error will be raised. 

@@ variadic-functions-examples/too-many.php.type-errors @@

Hack has specific notation specify that a function can take extra arguments. By putting `...` as the last argument to a function, you are telling the typechecker that the function can take a variable number of arguments.

@@ variadic-functions-examples/with-notation.php @@

The types of the variable arguments can be anything you want. Of course, the non-variadic arguments to the function must be of the type specified.

## Type Annotations and Variadic Functions

It is important to note that there is a [conflict between the typechecker and HHVM](../types/advanced-rules#variadic-arguments) when it comes to adding a typehint to a variadic argument.

Basically, although the typechecker allows and supports them, HHVM currently does not. See the above link for details.
