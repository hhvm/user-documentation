# Hack Operators

Hack introduces a few new operators beyond those which exists in PHP.

## `==>` ([Lambda operator](lambda.md))

Allows for a more concise representation of [PHP closures](http://php.net/manual/en/functions.anonymous.php) with the benefit of capturing variables from the enclosing function body implicitly.

## `?->` ([null-safe operator](null-safe.md))

Allows for method and property calls without explicit checks to ensure that the object being referenced is non-`null`

## `$_` ([Placeholder variable operator](placeholder-variable.md))

Allows for variables of any type to be assigned to it with the explicit agreement that the variable will not be used after assignment. A canonical example is iterating over key/value pairs where you don't care about the value.

## `->:` ([XHP attribute access operator](xhp-attributes-access.md))

Allows for accessing XHP attributes without explicitly having to call `getAttribute()` on the XHP object.
