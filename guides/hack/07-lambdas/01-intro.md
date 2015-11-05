# Lambdas

Hack supports the creation of closures through a construct called lambda. Lambdas are generally less verbose than [PHP closures](http://php.net/manual/en/functions.anonymous.php) and are often used in conjunction with functions like [`array-filter()`](http://php.net/manual/en/function.array-filter.php) or [`array-map()`](http://php.net/manual/en/function.array-map.php).

## Syntax

A lambda is represented by the [lambada operator](../operators/lambda.md) `==>`. To the left of `==>` is the list of arguments to the closure. To the right, is an expression or list of statements enclosed by braces `{}`. See [lambda design](./design.md) for more information.  

## Difference From Traditional Closures

This example shows you how to make use of the shorter lambda syntax.
It also uses a [Vector](../reference/class/Vector/) which is a [Collection](../collections/intro.md).

@@ intro-examples/introduction.php @@

The above example is equivalent to the example below using PHP's traditional syntax for anonymous functions. You should see that lambdas make the code more readable and shorter.

@@ intro-examples/difference.php @@

Essentially, the `function ($name)` and `return` from the traditional closure was replaced with `$name ==>`

## Capturing variables

PHP provides the keyword `use` to capture variables from the enclosing scope. Hack's lambdas make this even easier. You can use variables implicitly inside of a lambda.

@@ intro-examples/capture-variables.php @@

Notice in `addLastName()` we are using the passed in parameter `$lastname` directly within the lambda whereas in `addLastNameTraditional`, the parameter `$lastName` must be explicitly captured and called out in a `use`.

**NOTE**: All captured variables are captured by value; capturing by reference is *not supported*. 
