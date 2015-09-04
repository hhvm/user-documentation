# Design

A lambda expression is denoted by using the lambda arrow `==>`.
Left to the arrow are arguments to the anonymous function and on the right hand side is either an expression or a list of statements enclosed in curly braces. Most of the time you will want to use the prior.

@@ 02-design-examples/introduction.php @@

Note that the definition of [`Vector::filter`](link to Vector::filter) is

     public function filter ( (function(Tv): bool) $callback ): Vector<Tv>

That way you can only pass a lambda that returns `bool`. Hack infers the types and will print an error if you don't pass a valid closure. Therefore you don't have to annotate lambdas most of the time.

## Annotating lambdas

Lambdas are equivalent to `Closures`, but you cannot typehint them as one. However you can annotate  them as `(function(parametertypes): returntype)` to provide type information. The more type information you have, the more errors you can catch early.

@@ 02-design-examples/annotation.php @@


## Syntax

Most of the time you need parenthesis around the arguments. However if there is only one untyped argument with no default value and your lambda has no return typehint, you may omit the parenthesis. See [examples](03-examples.md) for more information about this.

The `==>` operator has low precedence compared with other operators. This is convenient because it allows lambdas to have a complex body without the need of parenthesis. Furthermore, the operator is right associative and can be chained.

@@ 02-design-examples/chained.php @@
