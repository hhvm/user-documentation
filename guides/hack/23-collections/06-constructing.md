# Constructing Collections

Using Hack collections is quite similar to using arrays. In fact, you can use Hack collections in regular `<?php` files given they are built directly into the HHVM runtime (the only caveat is that in `<?php` files, you have to prefix the collections with `HH\`). 

Constructing a Hack collection can be done using `new` or what we call *literal syntax*. Both of these are essentially a hybrid of how you create arrays.

## Literal Syntax

If you want to create a Hack collection and provide the collection explicit values (or key/value pairs), then you want to use literal syntax.

```
$collection = <CollectionType> { val1, val2, ... , valN };
$collection = <KeyedCollectionType> { key1 => val1, key2 => val2, ... , keyN => valN}
```

@@ constructing-examples/literal.php @@

You can use literal syntax anywhere `array()` can be used, including initializing expressions for object or class properties.

@@ constructing-examples/class-property.php @@

There are no type arguments for literal syntax (e.g., `$v = Vector<int> {1};` is a syntax error). The typechecker will [infer](../types/inference.md) and keep track of the type internally.

## Using `new`

You can also use `new` to create an instance of a Hack collection. However, you must either pass the constructor a `Traversable` (like an array) or `null`.

```
$collection = new <CollectionType> (?Traversable<Tv> $t);
$collection = new <KeyedCollectionType> (?KeyedTraversable<Tk, Tv> $t);
```

@@ constructing-examples/new.php @@
