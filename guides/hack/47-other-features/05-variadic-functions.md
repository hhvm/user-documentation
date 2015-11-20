A variadic function can take a variable number of arguments. In PHP, all functions are variadic, even if they don't explicitly say so. So a function that looks like:

```
function foo ($a, $b) {}
```

can actually be passed more than 2 arguments. What happens if you do that is undefined, but it is allowed.

You can access the passed arguments to a function via [`func_get_args`](http://php.net/manual/en/function.func-get-args.php), [`func_get_arg`](http://php.net/manual/en/function.func-get-arg.php) and [`func_num_args`](http://php.net/manual/en/function.func-num-args.php).

In Hack, however, you cannot pass more arguments than are specified. A typechecker error will be raised. 

**NOTE**: HHVM will ignore the extra arguments and run the code as if two parameters were passed.

@@ variadic-functions-examples/too-many.php.type-errors @@

However, Hack has specific notation to make a function explicitly variadic. By putting `...` as the last argument to a function, you are telling the typechecker that the function can take a variable number of arguments.

@@ variadic-functions-examples/with-notation.php @@

The types of the variable arguments can be anything you want. Of course, the non-variadic arguments to the function must be of the type specified.

## Type Annotations and Variadic Functions

It is important to note that there is a [conflict between Hack and HHVM](../types/advanced-rules#variadic-arguments) when it comes to adding a typehint to a variadic argument.

Basically, Hack supports them; HHVM currently does not.
