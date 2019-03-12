Hack supports both generic *covariance* and *contravariance* on a type parameter.

Each generic parameter can optionally be marked separately with a variance indicator:
 * `+` for covariance
 * `-` for contravariance

If no variance is indicated, the parameter is invariant.

## Covariance

If `Foo<int>` is a subtype of `Foo<num>`, then `Foo` is covariant on `T`. 'co' means 'with'; and the subtype relationship of the generic
type goes with the subtype relationship of arguments to a covariant type parameter.  Here is an example:

@@ variance-examples/covariance.php @@

A covariant type parameter is for read-only types. Thus, if the type can somehow be set, then you cannot use covariance.

Covariance cannot be used as the type of a parameter on any method, or as the type of any mutable property, in that class.

## Contravariance

If `Foo<num>` is a subtype of `Foo<int>`, then `Foo` is contravariant on `T`. 'contra' means 'against'; and the subtype relationship
of the generic type goes against the subtype relationship of arguments to a contravariant type parameter.  Here is an example:

@@ variance-examples/contravariance.php @@

A contravariant type parameter is for write-only types. Thus, if the type can somehow be read, then you cannot use
contravariant. (e.g., serialization functions are a good use case).

A contravariant type parameter cannot be used as the return type of any method in that class.
