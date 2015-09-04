# Lambdas

Hack supports the creation of closures through a construct called lambda. Lambdas are generally less verbose than PHP closures and are often used in conjunction with functions like `filter` or `map`.

This example shows you how to make use of the shorter lambda syntax.
It also uses a [Vector](link to Vector) which is a [Collection](link to Collections).

@@ 01-introduction-examples/introduction.php @@

The above example is equivalent to the example below using PHP's traditional syntax for anonymous functions. You should see that lambdas make the code more readable and shorter.

@@ 01-introduction-examples/difference.php @@

## Capturing variables

PHP provides the keyword `use` to capture variables from the enclosing scope. Hack's lambdas make this even easier. You can use variables implicitly inside of a lambda.

@@ 01-introduction-examples/capture-variables.php @@
