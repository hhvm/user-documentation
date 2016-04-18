Hack supports most of the [PHP operators](http://php.net/manual/en/language.operators.php), including the recently introduced [null coalescing (`??`)](http://php.net/manual/en/language.operators.comparison.php) operator.

The current exception of support is the ["spaceship" (`<=>`)](http://php.net/manual/en/language.operators.comparison.php) operator; you can use it in your Hack code since [HHVM](/hhvm/) supports it, but it will not be [type checked](/hack/typechecker/introduction). 

Hack also introduces a few new operators beyond those which exists in PHP.

## `==>` ([Lambda operator](lambda.md))

Allows for a more concise representation of [PHP closures](http://php.net/manual/en/functions.anonymous.php) with the benefit of capturing variables from the enclosing function body implicitly.

## `?->` ([null-safe operator](null-safe.md))

Allows for method and property calls without explicit checks to ensure that the object being referenced is non-`null`.

## `->:` ([XHP attribute access operator](XHP-attribute-access.md))

Allows for accessing XHP attributes without explicitly having to call `getAttribute()` on the XHP object.

## `|>` ([Pipe operator](pipe-operator.md))

Allows for a fluid, concise syntax for chaining expressions.
