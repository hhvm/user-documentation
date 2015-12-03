Hack's most well-known feature is strict typing, with fast ahead-of-time static verification.

## What is typing?

This is the process of assigning explicit types to member variables, parameters, return values, and other components of code. 

For example, in regular PHP you can create function parameters without any type defined:

@@ typing-examples/php-function.php @@

While the `$b` might be a `string` in the developer's mind, some of this code will try to use this parameter as if it were an `int`, or an `array` or any other type. 

Now imagine that you're testing this code, and every time you see it work because the value of `$a` is always greater than 0. You might assume that this is a bug-free piece of code, when clearly this is not the case. As soon as `$a` was a value equal to or less than 0, you'd get a run-time error. 

This is a very over-simplified example, but when you expand this up to much bigger functions with dozens of parameters, it can be easy to miss simple type-related bugs.

Hack introduces the concept of typing in order to protect against these kinds of run-time errors. So now you can explicitly tell Hack that what type you intend a variable to be:

@@ typing-examples/hack-function.php @@

And immediately a type-checker will be able to catch the fact that `echo (5 . $b)` is operating on two different types, and will prevent this erroneous code from compiling, and potentially being pushed live. 

**Statically typed languages** do their type checking during compile-time, and generally prevent type-related errors from making their way into live code.

**Dynamically typed languages** do their type checking at run-time, which allows more flexibility at the expense of letting type errors through. 

Hack lets you use the strong typing features of a statically typed language when you want, but still gives you the flexibility of a dynamically typed language. 

## Why Is This Useful?

Let's be clear here - if you're writing code, the chances are it is at the very least implicitly typed, that is - when you create a line of code, you have in your mind what type the variables, parameters, etc. are supposed to be. 

What typing does, and by extension what Hack does, is to help developers make fewer mistakes and **introduce fewer errors** by:

* Catching bugs at compile-time.
* Allowing for IDEs that can autocomplete with type-aware functions, and provide inline error notifications. 
* Improving clarity of intent for other developers.
* Preventing unsafe coding practices like sketchy null checks.

## Further Reading

Our [Types Documentation](/hack/types/introduction) provides much more detailed information about this feature.
