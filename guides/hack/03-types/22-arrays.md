The preferred object types for providing array-like storage and operations are `vec`, `dict`, and `keyset`.  These supersede the earlier Hack 
types `Vector`, `Map`, and `Set`, and the legacy `array` type inherited from PHP. 

## vec

A vec (short for vector) is a data structure that contains a collection of zero or more elements whose values are each accessed through a 
corresponding `int` key. As the number of elements in a vec can change at runtime, a vec type declaration does *not* include an element count.  
Consider the following class properties:

```Hack
private vec<string> $colorsVec = vec["red", "white", "blue"];
private vec<num> $valuesVec = vec[123, 567.89];
```

`$colorsVec` has an implicit key type of `int`, and an explicit value type of `string`.  The vec is created and initialized using a *vec-literal*, 
which has the general form `vec[`...`]`. There are three elements, and their corresponding keys are 0, 1, and 2. `$valuesVec` has an implicit key 
type of `int`, and an explicit value type of `num`.  There are two elements (of type `int` and `float`, respectively), and their corresponding keys 
are 0 and 1.

An existing element is accessed via the subscript operator, `[]`, and the value of an element can be changed; however, new values can only be added 
to the end by using subscript `[]`, and key values always start at 0, and go up in increments of 1. Consider the following:

@@ arrays-examples/vec-colors.php @@

The `foreach` statement can be used to iterate over the elements in a vec, starting at the element with key 0. This statement provides a way to 
access the key and value for each element.

Elements *cannot* be removed from a vec.

## dict

While a vec always has a key type of int, a dict (short for dictionary) requires the key type to be specified. As the number of elements in a 
dict can change at runtime, a dict type declaration does *not* include an element count.  Consider the following class properties:

```Hack
private dict<int, string> $colorsDict = dict[1 => "white", 2 => "blue", 0 => "red"];
private dict<int, num> $valuesDict = dict[0 => 123, 1 => 567.89];
```

A dict has an explicit key type, as well as a value type.  In this example, the dict is created and initialized using a *dict-literal*, which 
has the general form `dict[`...`]`, in which explicit key values are required. Unlike a vec, key values in a dict need not start at 0, nor need 
they be consecutive.

Note, carefully, that although `$colorsVect` and `$colorsDict` result in collections of `int`/`string` pairs, these variables do *not* have the 
same (or even compatible) types! That said, there are library functions to convert between vec and dict objects. 

Consider the following:

@@ arrays-examples/dict-colors.php @@

The key type can be `string`; for example:

```Hack
private dict<string, int> $fruitDict = dict['oranges' => 25, 'apples' => 12, 'pears' => 17];
```

The key type **must** be `int` or `string`.

A dict is represented as an ordered map in which each entry is a key/value pair that represents an element. Duplicate keys are not permitted. 
The order of the elements in the map is the order in which the elements were inserted into the dict. An element is said to *exist* once it has 
been inserted into the dict with a corresponding key. A dict is *extended* by initializing a previously non-existent element using a new key. 

The `foreach` statement can be used to iterate over the elements in a dict, in their order of insertion. This statement provides a way to access 
the key and value for each element.

To remove an element from a dict, use `unset`.

## keyset

A keyset is a data structure that contains a collection of zero or more elements whose values are the keys. And as array keys must have 
type `int` or `string`, keysets are restricted to homogenous collections of values of those types. As the number of elements in a keyset 
can change at runtime, a keyset type declaration does *not* include an element count.  Consider the following class properties:

```Hack
private keyset<string> $colorsSet = keyset["red", "white", "blue"];
private keyset<int> $valuesSet = keyset[22, 55, 77, 99];
private keyset<arraykey> $thingsSet = keyset["red", "white", 123];
```

`$colorsSet` has a key and value type of `string`.  The keyset is created and initialized using a *keyset-literal*, which has the general 
form `keyset[`...`]`. There are three elements, and their corresponding keys are their values. `$valuesSet` has a key and value type of `int`. 
`$thingsSet` has a key and value type of `arraykey`, so it can contain both `int`- and `key`-typed elements.  	

An existing element is accessed via the subscript operator, `[]`; the value of an element cannot be changed. And new values can only be added 
by using subscript `[]`. Consider the following:

@@ arrays-examples/keyset-colors.php @@

Attempts to add duplicate keys are accepted but ignored.

The `foreach` statement can be used to iterate over the elements in a keyset, in their order of insertion.

To remove an element from a keyset, use `unset`.

## Legacy Vector, Map, and Set

Early in Hack’s life, the library provided mutable and immutable generic class types called: `Vector`, `ImmVector`, `Map`, `ImmMap`, `Set`, 
and `ImmSet`. However, these have been replaced by `vec`, `dict`, and `keyset`, whose use is recommended in all new code. Each generic type 
had a corresponding literal form. For example, a variable of type `vector<int>` might be initialized using `Vector {22, 33, $v}`, where `$v` 
is a variable of type `int`.

## Legacy array

**`array` is a hold-over type from PHP. Due to some of the limitations of this type, Hack programmers are encouraged to use `vec`, `dict`, 
and `keyset` instead.**

Within this section, the term *array* means *legacy array*.

Note: Legacy arrays are quite different to arrays in numerous mainstream languages. Specifically, legacy array elements need not have the 
same type, the subscript index need not be an integer (so there is no concept of a base index of zero or one), and there is no concept of 
consecutive elements occupying physically adjacent memory locations.

An array is a data structure that contains a collection of zero or more elements whose values are each accessed through a corresponding key. 
As the number of elements in an array can change at runtime, an array type does *not* include an element count.  Consider the following class 
property, which has an array type:

```Hack
private array<string> $colorsVect = array("red", "white", "blue");
```

This is a *vector-like* array, and it has an implicit key type of `int`, and an explicit value type of `string`.  This array is created 
and initialized using the array-creation intrinsic function, `array(...)`.  (There is an equivalent array-creation operator `[...]`.) 
There are three elements, and their corresponding keys are 0, 1, and 2.

An array’s key type can be declared explicitly; for example:

```Hack
private array<int, string> $colorsMap = array("red", "white", "blue");
```

This is a *map-like* array, with an explicit key and value type.  As before, there are three elements, and their corresponding keys are 0, 1, and 2.  

Note, carefully, that although `$colorsVect` and `$colorsMap` result in arrays of `int`/`string` pairs, they do *not* have the same (or 
even compatible) types!

When we create a map-like array, we can specify the key values as well; for example:

```Hack
private array<int, string> $colorsMap 
  = array(-10 => "white", 12 => "blue", 0 => "red");
```

Note how the key values do not start at 0, nor are they consecutive!

The key type can be other than `int`; for example:

```Hack
private array<string, int> $fruitMap = array('oranges' => 25, 'apples' => 12, 'pears' => 17);
```

Although we can use any type as an array’s key type, behind the scenes, the key is actually represented as an `int` or `string`, 
so---possibly surprising, or at least, unexpected---conversions occur when other key types are specified. **Programmers are strongly 
advised to avoid using key types other than `int` or `string`.**

Each element in an array must have a value type that is the exact type indicated by the array declaration, or a 
[subtype](./supertypes-and-subtypes.md) of that type. For example:

```Hack
private array<num> $numbers = array(5.4, 234);
private array<mixed> $misc = array(10, 'b', false);
```

The vector-like array `$numbers` has type `num` and contains a `float` and an `int`, respectively.  The vector-like array `$misc` has type `mixed`, 
and contains an `int`, a `string`, and a `bool`, respectively.

An array element can have any type (which allows for arrays of arrays).  For example:

```Hack
private array<array<int>> $counts = array(array(10,20), array(2,3));
```

`$counts` is a vector-like array of two elements each of which is a vector-like array of two elements, each of which is an `int`.

An array is represented as an ordered map in which each entry is a key/value pair that represents an element. Duplicate keys are not permitted. 
The order of the elements in the map is the order in which the elements were inserted into the array. An element is said to *exist* once it has 
been inserted into the array with a corresponding key. An array is *extended* by initializing a previously non-existent element using a new key. 
Elements cannot be removed from an array.

The [`foreach` statement](../statements/foreach.md) can be used to iterate over the collection of elements in an array, in the order in 
which the elements were inserted. This statement provides a way to access the key and value for each element.

The value (and possibly the type) of an existing element is obtained or changed, and new elements are inserted, using the 
[subscript operator `[]`](../expressions-and-operators/subscript.md).  For example:

@@ arrays-examples/legacy-array-colors.php @@

@@ arrays-examples/legacy-array-fruits.php @@

Two arrays can be compared using [relational operators](../expressions-and-operators/relational.md) and 
[equality operators](../expressions-and-operators/equality.md).

Numerous library functions are available that manipulate arrays.

