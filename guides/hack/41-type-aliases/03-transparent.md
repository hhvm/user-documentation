A *transparent type alias* is one created using `type`. 

```
<?hh
type UserIDtoFriendIDsMap = Map<int, Vector<int>>;
```

For a given type, that type and all transparent aliases to that type are all the same type, and can be freely interchanged. There are no restrictions on where a transparent type alias can be defined or which source code can access its underlying implementation.

If the compiler *never* distinguishes between a type alias name and the type to which it is aliased, why go to the trouble of defining the abstract alias type? Ordinarily you wouldn't! After all, in an ideal world, the whole point of having an abstract type is to allow code to be written that does *not* rely on how that type is actually represented. However, the world is not always ideal! 

Consider the case in which some type T is used throughout a lot of source modules. The decision is made to (eventually) hide that type's implementation from most higher-level code, but it is not possible to convert all the usage code at once; instead, it is to be done one module at a time. We can do this by defining a transparent type alias TTA for type T. Then new modules can be written that reference TTA, and existing modules can be changed to use TTA one at a time.

Compare this kind of alias with [Opaque Type Aliases](./opaque.md).

@@ transparent-examples/transparent.php @@

Transparent type aliases can be implicitly converted to their underlying types and vice-versa.
