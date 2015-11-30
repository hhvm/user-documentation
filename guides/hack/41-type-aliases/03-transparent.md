A *transparent type alias* is one created using `type`. 

```
<?hh
type UserIDtoFriendIDsMap = Map<int, Vector<int>>;
```

For a given type, that type and all transparent aliases to that type are all the same type, and can be freely interchanged -- they are completely equivalent in all respects. There are no restrictions on where a transparent type alias can be defined or which source code can access its underlying implementation.

Unlike [opaque type aliases](./opaque.md), since nothing distinguishes between the alias and the aliased type, transparent type aliases aren't particularly useful as an abstraction mechanism. Their primary use case is in defining a shorthand type name increase readability and to save typing. Consider the following function signature, and how much more cumbersome it would be without the `Matrix` type alias:

@@ transparent-examples/transparent.php @@
