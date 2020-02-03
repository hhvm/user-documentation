Hack supports the ability to encapsulate an unnamed function and to use it, or save it for later use, in the context of an anonymous function object.

An anonymous function type has the following general syntax:

`(function (` *optional-comma-separated-parameter-list* `):` *return-type* `)`

For example:

```Hack
function do_it((function (int): int) $process, int $value): int { ... }

class C {
  private (function (int): int) $af;
  ...
}
```

Function `do_it` takes two arguments, the first of which is an anonymous function taking one `int` argument and returning an `int` result.
The instance property `$af` in class `C` has the same type.

There are two ways to create an anonymous function object: via a
closure creation expression or a lambda creation expression.

Consider the following example which shows both approaches:

@@ anonymous-functions-examples/anonymous-function.php @@

A closure-creation expression looks a lot like an anonymous-function type declaration. See the right-hand side of the assignment to `$closure`.
Everything from `function` through `}` is an anonymous-function expression, often referred to as a *closure*. It gives each parameter a local
name, and contains the body of the function, which, in this case, simply returns a value double that of the one passed in. The resulting object
can then be used to call that function, as in `$closure(5)`.

That same closure is also passed to function `do_it`, which calls it without knowing which function it is actually calling.

A lambda-creation expression involves the `==>` operator and omits the keywords `function` and `return`. See the right-hand side of the
assignment to `$lambda`. Everything from `(` through `2` is an anonymous-function expression, often referred to as a *lambda*. It gives
each parameter a local name, and contains the body of the function, which, in this case, simply returns a value double that of the one passed in.
The resulting object can then be used to call that function, as in `$lambda(5)`.

The `==>` operator is right-associative, and lambda expressions can be chained together; for example:

@@ anonymous-functions-examples/chaining.php @@

Note that all the parameter types and return types are absent in the lambda-creation expression; they can be omitted, in which case, they are
inferred. For completeness, here's the same expression written with explicit type information:

```Hack
$lam1 = (int $x): (function(int): int) ==> (int $y): int ==> $x + $y;
```

Consider the following example, in which an anonymous function accesses variables declared outside it:

@@ anonymous-functions-examples/use-clause.php @@

Function `get_process_1` uses a closure-creation expression, but this time, it has a `use` clause, whose parentheses contain a comma-separated
list of variable names that the anonymous function can reference.

Function `get_process_2` uses a lambda-creation expression, which automatically has access to all variables in scope at the point where that
anonymous function is defined. No `use` clause is needed.

Note the expression `get_process_2(2)(4)`. As `get_process_2` is a function, we can call that. And as it returns an anonymous function, we can call that.

Consider the following example, which calls an anonymous function stored in an instance property:

@@ anonymous-functions-examples/run-method.php @@

The assignment to the local variable `$tmp` and then calling through that in method `run` seems unnecessary. Why can't we simple replace these
two statements with

```Hack
return $this->af($p);
```

The problem is that a class is permitted to contain a property and a method having the same name! As such, `$this->af()` causes the checker to
search for a method called `af` when none exists.

Like named functions, anonymous functions can have attributes, default argument values, and variable-argument lists, and they can be
[asynchronous](../asynchronous-operations/introduction.md).

If an anonymous function's parameter's type is omitted, that type is inferred, and if the function's return type is omitted, that is also inferred.

For both `__FUNCTION__` and `__METHOD__`, an anonymous function name is `{closure}`.
