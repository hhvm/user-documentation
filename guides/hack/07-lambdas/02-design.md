# Design

A lambda expression is denoted by using the lambda arrow `==>`. Left of the arrow are arguments to the anonymous function and on the right hand side is either an expression or a list of statements enclosed in curly braces `{}`.

@@ design-examples/introduction.php @@

## Annotating lambdas

Lambdas are equivalent to `Closures`, but you cannot [type annotate](../types/annotations.md) them as a `callable`. However, you can:

* annotate a passed or returned lambda call as `(function(parametertypes): returntype)` to provide type information.
* annotate the lambada itself, both the arguments and the lambda return type.
 
The more type information you have, the more errors you can catch early.

@@ design-examples/annotation.php @@

Note that the definition of a function like[`Vector::filter`](link to Vector::filter) is:

     public function filter ( (function(Tv): bool) $callback ): Vector<Tv>

That way you can only pass a lambda that returns `bool`. Hack infers the types and will print an error if you don't pass a valid closure. Therefore you don't have to annotate lambdas in many cases.

## Parenthesis Around Arguments

Most of the time you need parenthesis around the arguments. However, if there is only one argument without a type annotation, with no default value, and your lambda has no return type annotation, you may omit the parenthesis. See [examples](./examples.md) for more information about this.

## Precedence

The `==>` operator has low precedence compared with other operators. This is convenient because it allows lambdas to have a complex body without the need of parenthesis. Furthermore, the operator is right associative and can be chained.

@@ design-examples/chained.php @@
