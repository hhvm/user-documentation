This section covers the different built-in types available in Hack.

## Primitive Types
Hack has the following primitive types: 
[bool](/hack/built-in-types/bool), 
[int](/hack/built-in-types/int), 
[float](/hack/built-in-types/float), and 
[string](/hack/built-in-types/string).

* Some types are subtypes of other types: for example, `int` and `float` are subtypes of [num](/hack/built-in-types/num).
* Similarly, `int` and `string` are subtypes of [arraykey](/hack/built-in-types/arraykey).
* Other types, like [mixed](/hack/built-in-types/mixed), act as supertypes, whereas [nothing](/hack/built-in-types/nothing) acts as the complete opposite (no type).
* Finally, [null](/hack/built-in-types/null) and [nonnull](/hack/built-in-types/nonnull) are mutually exclusive to one another.

## Hack Arrays
There are three types of [Hack Arrays](/hack/arrays-and-collections/introduction). They are:
[vec](/hack/arrays-and-collections/hack-arrays#vec),
[keyset](/hack/arrays-and-collections/hack-arrays#keyset), and 
[dict](/hack/arrays-and-collections/hack-arrays#dict).

Though not built-in as types, other alternatives exist in [Hack Collections](/hack/arrays-and-collections/collections).

## Other Built-In Types
Hack has other built-in types too, like:
[enum](/hack/built-in-types/enum) (with [enum class](/hack/built-in-types/enum-class) and [enum class labels](/hack/built-in-types/enum-class-label)
),
[shape](/hack/built-in-types/shapes), and 
[tuples](/hack/built-in-types/tuples).

## Function Return Types
Other types like [noreturn](/hack/built-in-types/noreturn) and [void](/hack/built-in-types/void) are only valid as function return types .

## Special Types
These last few types are special in their utility and/or versatility: 
[classname](/hack/built-in-types/classname), 
[dynamic](/hack/built-in-types/dynamic), and
[this](/hack/built-in-types/this).
