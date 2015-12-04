Hack's most basic feature is type annotations. Typing of objects have been around since PHP5, and PHP7 offers scalar typing as well. Hack provides across the board type annotations, in conjunction with fast, ahead-of-time static verification with its typechecker.

## What are type annotations?

Type annotations allow the explicit types to member variables, parameters, return values, and other components of code.

For example, consider the following code, written in regular PHP, without any types:

@@ typing-examples/php-function.php @@

The author of this code clearly intended for both `$a` and `$b` to be `int`s, since the code is using arithmetic operations to manipulate them. But nothing is actually enforcing that, to make sure it's really the case.

Imagine that you're testing this code, and every time you see it work because the value of `$a` is always and `int`, and always greater than 0. You might assume that this is a bug-free piece of code, when this might not be the case: unintended behavior will result if `$b` is ever not an `int`, but that will only show up when `$a <= 0` as well!

Hack's type annotation mechanism helps protect against these kinds of run-time errors. So now you can explicitly tell Hack that what type you intend a variable to be:

@@ typing-examples/hack-function.php @@

The typechecker now knows exactly the programmer's intent for the `bar` function: it must always take two integers. The typechecker can scan all of your code and know, before a single line of it executes, whether that invariant will be satisfied. It doesn't matter what the value of `$a` is at runtime -- the typechecker makes sure that the type of `$b` is correct regardless. In other words, Hack's typechecker performs static type checking -- Hack is a statically typed language.

**Statically typed languages** do their type checking during compile-time, and generally prevent type-related errors from making their way into live code.

**Dynamically typed languages** do their type checking at run-time, which allows more flexibility at the expense of letting type errors through.

Hack lets you use the strong typing features of a statically typed language when you want, but still gives you the flexibility of a dynamically typed language.

## Why Is This Useful?

If you're writing code, the chances are it is at the very least implicitly typed; when you create a line of code, you have in your mind what type the variables, parameters, etc. are supposed to be. What Hack's type annotation mechanism allows is to help developers make fewer mistakes and **introduce fewer errors** by:

* Catching bugs before runtime.
* Allowing for IDEs that can autocomplete with type-aware functions, and provide inline error notifications.
* Improving clarity of intent for other developers.
* Preventing unsafe coding practices like [switch fallthrough](/hack/types/advanced-rules#fallthrough).

## Further Reading

Our [types documentation](/hack/types/introduction) provides much more detailed information about this feature.
