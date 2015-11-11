# Hack Operators

Hack introduces a few new operators beyond those which exists in PHP.

## `==>` ([Lambda operator](lambda.md))

Allows for a more concise representation of [PHP closures](http://php.net/manual/en/functions.anonymous.php) with the benefit of capturing variables from the enclosing function body implicitly.

## `?->` ([null-safe operator](null-safe.md))

Allows for method and property calls without explicit checks to ensure that the object being referenced is non-`null`

## `->:` ([XHP attribute access operator](xhp-attributes-access.md))

Allows for accessing XHP attributes without explicitly having to call `getAttribute()` on the XHP object.
