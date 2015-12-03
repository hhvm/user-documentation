Describing types in Hack is largely done through explicit [annotations](annotations.md) in your Hack source code. Hack has a large list of possible annotation types. You can check out a summary of each of these types in our [table](summary-table.md).

## Common Primitives

The main primitive types available in PHP are available as explicit type annotations in Hack. These include:

- `bool`
- `int`
- `float`
- `string`
- `array`
- `resource`

@@ type-system-examples/primitive.php @@

### Alias Primitives

Alias primitives are **not supported** in Hack. So the following are not valid types to be used in type annotations:

- `boolean`
- `integer`
- `real`
- `double`


## `void`

`void` is a special primitive type that means that a function or method returns no observable value. You can use `return;` in a `void` function.

**NOTE**: `void` can only be used in method or function returns. It is not applicable to properties or parameters.

@@ type-system-examples/void.php @@

### In Async

It is relatively common for [async](../async/introduction.md) functions to return `Awaitable<void>`. This means that while the function itself is returning an awaitable, the result of that awaitable will have no value. This, in essence, means the async function did some operation asynchronously that did not require a return value to the caller. 


## `noreturn`

`noreturn` is a special primitive type that means that a function or *static* method never returns a value. Similar to `void`, but you cannot even use `return;` in a function that has a return type of `noreturn`. 

`noreturn` is used to indicate that a given function or *static* method always throws an exception or somehow terminates the program within the function itself.

@@ type-system-examples/noreturn.php.type-errors @@

**NOTE**: 

### Only Static Methods and Functions

`noreturn` can only be used in function or *static* method returns.

Instance methods *cannot* be `noreturn`. This is due to the order in which the typechecker's analysis phases happen. The return type of an instance method call cannot be determined during control flow analysis because it needs to know the type on the left-hand side of the `->`, and the results of type inference aren't available yet. This isn't an issue for calls to static methods, since those can be resolved before types have been inferred.

`noreturn` is not applicable to properties or parameters.

## Objects

You can use the name of any built-in or custom class or interface.

@@ type-system-examples/object.php @@


## `mixed`

`mixed` is essentially a catch-all type that represents any possible Hack value (including `null` and `void`).

@@ type-system-examples/mixed.php @@

### Use sparsely

There are valid uses for `mixed`, but generally you want to be as specific as possible with your typing since the typechecker can only do so much with `mixed` given its constraints are so lax.


## `this`

`this` can only be used as a *return type* annotation on a *method of a class*. `this` signifies that the method returns an object of the same class on which the method is defined.

The primary purpose of return `this` is to allow chaining of method calls on the instance of the class itself or its subclasses.

@@ type-system-examples/this-chaining.php @@

`this` on a `static` method means that a class method returns an object of the same class as the calling method. You can use it to return an instance of an object from a `static` class method where you are returning something like `new static()`.

@@ type-system-examples/this-static.php @@


## `num`

`num` is special union type of `int` and `float`. Normally, in Hack, `int`s and `floats` are incompatible types. However it was realized that many numerical operating functions work similarly whether you pass an integer or a float. `num` is used for those cases.

@@ type-system-examples/num.php @@


## `arraykey`

`arraykey` is special union type of `int` and `string`. Arrays and [collection](../collections/introduction.md) types can be keyed by `int` or `string`. Suppose, for example, an operation was performed on an array to extract the keys, but you didn't know the type of the key. You were left with using `mixed` or doing some sort of duplicative code. `arraykey` resolves that issue.

@@ type-system-examples/arraykey.php @@


## XHP

There are two [XHP](../xhp/introduction.md) interfaces that are used when typing XHP objects: `XHPChild` and `XHPRoot`.

`XHPRoot` is any object that is an instance of an XHP class. 

`XHPChild ` is the set of valid types for `echo`ing within an XHP context (e.g., `echo <div>{$xhpobj}</div>;`). This includes the primitive types of `string`, `int` and `float`, along with arrays of those types plus any XHP object.

@@ type-system-examples/xhp.php @@


## Nullable

A nullable type is represented by a `?` placed as a prefix to the type itself (e.g., `?int`). It merely means that the value can be of that type or `null`. 

@@ type-system-examples/nullable.php @@

### What can't be nullable?

`void`, `noreturn` cannot be nullable because `null` is a valid and observable return value. 

As `mixed` already allows for the value `null`, you cannot write `?mixed`.


## Generics

[Generics](../generics/introduction.md) allows a specific piece code to work against multiple types in a type-safe way. Depending on the type parameter specified, a generic type can work against one type or many. `Box<T>` for example is the most permissive for types that can be passed to it. `array<int>` is the least permissive as `int`s are only allowed to be placed in the array.

@@ type-system-examples/generics.php.type-errors @@


## Enums

An [enum](../enums/introduction.md) is a type made up of constants, usually related to each other. Unlike class constants, etc., enums are first-class types in the Hack type system. As such, they can be used as type annotations anywhere a primitive or object type can.

@@ type-system-examples/enum.php @@


## Callables

There is a `callable` typehint, but Hack does not allow it (HHVM accepts it, however if you don't care about the type checker errors).

Instead, Hack provides a more expressive [callable](../callables/introduction.md) type of the form:

```
function(0..n parameter types): return type
```

@@ type-system-examples/callable.php @@


## Tuples

[Tuples](/hack/tuples/introduction) provide a type specifying a fixed number of values of possibly different types. The most common use of a tuple is to return more than one value from a function. 

```
(type1, ... ,type n)
```

Tuples are like fixed arrays. You cannot remove or change any of the types from a tuple, but you can change the values of each type. To create a tuple, you use the same syntax as an array, but s/`array`/`tuple`. 

```
tuple(value1, ..., value n);
```

@@ type-system-examples/tuple.php @@


### Arrays under the covers

In HHVM, tuples are implemented as arrays, and you can call `is_array()` on them and get a `true` returned.


## Type Aliases

[Type aliases](../type-aliases/introduction.md) allow you to give a new name to an existing type. They can be used just like those existing types in annotations.

@@ type-system-examples/type-alias.php @@


### Classname<T>

`Foo::class` in PHP refers to the string constant containing the fully qualified name of `Foo`. 

Hack introduces a special type aliases called [`classname<T>`](../type-aliases/opaque.md#classname). So, now when someone writes `Foo::class`, not only does the Hack typechecker recognize the string representation of the class, but also this new type that provides semantics of the class itself.

@@ type-system-examples/classname.php.type-errors @@


## Shapes

[Shapes](../shapes/introduction.md) are a specific type alias representing a structured array, with a deterministic name and type of keys. They can be used as type annotations as well.

@@ type-system-examples/shape.php @@
