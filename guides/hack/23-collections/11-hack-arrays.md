Hack also provides additional "array-like" types: `dict`, `vec`, and `keyset`;
we expect these to eventually replace the collection objects, and will be
recommending they are used instead once the
[Hack Standard Library](https://github.com/hhvm/hsl) leaves 'preview' status.

## The Types

 - `vec<T>` is an indexable and traversable container of items of type `T`; it
   supercedes `Vector`, `ImmVector`, and `ConstVector`
 - `dict<Tk as arraykey, Tv>` is an indexable and keyed traversable container of
   items of type `Tv`; it supercedes `Map`, `ImmMap`, and `ConstMap`. `Tk` must
   be an `arraykey`, i.e. `string` or `int` keys.
 - `keyset<T as arraykey>` is an indexable and keyed traversable container of
   unique items of type `T`; it supercedes `Set`, `ImmSet`, and `ConstSet`. It
   can only contain `arraykey` values, i.e. `string` or `int`.

All of these types preserve insertion order.

## Creating Hack Arrays

Literals are created with `[]` syntax:

@@ hack-arrays-examples/literals.php @@

Additionally, Hack provides the following conversion functions:
 - `vec<Tv>(Traversable<Tv>): Vec<Tv>`
 - `dict<Tk as arraykey, Tv>(KeyedTraversable<Tk, Tv>): dict<Tk, Tv>`
 - `keyset<Tv as arraykey>(Traversable<Tv>): keyset<Tv>`

@@ hack-arrays-examples/conversions.php @@

## Compared to Hack Collections

Hack Collections (`Vector`, `Map`, `Set`, ...) are objects; Hack Arrays
(`vec`, `dict`, `keyset`) are values. The primary implications are:

 - Hack Collections are implicitly passed by reference
 - Hack Arrays are implicitly passed by value, with copy-on-write-like behavior
 - Hack Arrays do not have methods and require library functions
 - There is no need for `Const` or `Imm` variants of Hack Arrays

The difference between reference and copy-on-write semantics is shown below:

@@ hack-arrays-examples/ref-vs-cow.php @@

## Compared to PHP Arrays

 - Hack Arrays do not implicitly convert int-like string keys to ints
 - Hack Arrays throw exceptions instead of returning null when undefined
   indices are accessed
 - Can not contain references

The ban on references is demonstrated below:

@@ hack-arrays-examples/can-not-contain-references.php @@

## Library functions

As Hack Arrays are not objects, they do not have methods. Library support is
provided via the [Hack Standard Library](https://github.com/hhvm/hsl).
