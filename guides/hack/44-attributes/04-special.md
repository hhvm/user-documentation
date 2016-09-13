Attributes usually don't have any special runtime or typechecking semantics. However, there are attributes starting with `__` (double underscore) that are specially recognized by HHVM and/or the typechecker.

## `<<__Override>>`

When the `__Override` attribute is specified on a method, the typechecker will determine that the method is overriding a method from a parent class. If it is not, the typechecker will raise an error.

@@ special-examples/override.php.type-errors @@

The attribute can be applied to traits, but the checks occur on classes that use the trait, not on the trait itself.

Since this is enforced only by the Hack typechecker, the overridden method must be in a Hack file.

## `<<__ConsistentConstruct>>`

In Hack, as in PHP, it is perfectly acceptable for a child class to have a different `__construct()` signature than its parent. However, many times this is not intended behavior and so there must be a way to ensure that constructors that should be consistent were indeed consistent.

On classes annotated with `__ConsistentConstruct`, the typechecker will be make sure all child classes have matching signatures for the constructor.

This attribute is particularly helpful for polymorphic calls where it may not be known ahead of time which constructor will be called such as `new static()`:

@@ special-examples/consistent-construct.php.type-errors @@

### Overriding Consistent Construct

There may be a case where a parent class has been marked with `__ConsistentConstruct`, but you want a specific child class to override this requirement. In those cases, you can use the `__UNSAFE_Construct` attribute.

@@ special-examples/consistent-construct-override.php @@

As the name suggests, using this attribute is just as unsafe as the [other `UNSAFE` annotations the typechecker accepts](/hack/typechecker/special)!

## `<<__Memoize>>`

The `__Memoize` attribute allows functions or methods to cache their results for the duration of a given request. Memoization is used primarily to cache the result of otherwise time-consuming operations.

@@ special-examples/memoize.php @@

### Limitations

- You cannot memoize variadic functions (e.g., `varargs` functions)
- You cannot memoize functions that take any arguments by reference (e.g., `&`)
- All arguments to the function being memoized must be of:
  - `bool`
  - `int`
  - `float`
  - `string`
  - [Nullable](../types/type-system.md#Nullable) of the above (e.g., `?int`)
  - Array or collection of the above types (e.g., `Map<int>`)
  - An object of a class that implements the `IMemoizeParam` interface

### `IMemoizeParam`

If you want your class to be validly used as a parameter to a memoized function or method, then your class must implement the `IMemoizeParam` interface.

```
interface IMemoizeParam {
   /**
   * Serialize this object to a string that can be used as a
   * dictionary key to differentiate instances of this class.
   */
  public function getInstanceKey(): string;
}
```

### Gotchas

`__Memoize` can be a real time saver and provide some performance improvements, but there are some gotchas that you should be aware of when using it.

- While performance can rise, memory usage will also rise because you are caching results in memory.
- Memoization only lasts for the current request - is not shared between requests.
- HHVM can actually free memory used by memoized results if needed. Thus, sometimes, a memoized result might be removed from memory and the time consuming operation will happen again. This can be a good thing though as HHVM is managing the memory for you properly.
- HHVM makes no guarantees about the side effects your memoization may have.
- Your function will return the same object, which means that, if your object mutated, all return values for previous and future calls to the function will have that mutation. Sometimes that's exactly the behavior we want - say, a singleton. However, if we are just caching a result of a fetch, it could be disastrous if someone erroneously changed that returned object in-place and suddenly every other caller is using a corrupted object. To avoid that, you can use [`Immutable Collections`](/hack/collections/classes#immutable-collections) or design your own immutable return type.

## `<<__Deprecated($message, $sample_rate = 1)>>`

In the past, to show that a function or method was deprecated, you would need to call something like `trigger_error()` passing in `E_DEPRECATED` or `E_USER_DEPRECATED`. The deprecation would only be known at runtime.

The `__Deprecated` attribute is added to function or method to indicate that it should no longer be called. The typechecker will flag any calls to such a function or method as an error. HHVM will also issue a [`E_USER_DEPRECATED`](http://php.net/manual/en/errorfunc.constants.php) warning if your call makes it to runtime.

The runtime error messages will get sampled at a rate of `1 / $sample_rate`, which is helpful if you are deprecating a heavily-used function.

@@ special-examples/deprecated.php.type-errors @@

### Your logs may fill up

Using this attribute could fill your logs with `E_DEPRECATED` warnings when calling methods or functions that are deprecated. This is an impetus for removing this function sooner rather than later.

## Uncommon

The following attributes are much less useful and much less common than the above, but are included for completeness.

### `<<__MockClass>>`

Mock classes are very useful in testing frameworks when you want to test functionality provided by a legitimate, user-accessible class by creating a new class (many times a child class) to help with the testing.

However, what if a class is marked as `final` or a method in a class is marked as `final`? Your mocking framework would generally be out of luck.

The `__MockClass` attribute allows you to tell HHVM to override the restriction of `final` on a class or method within a class so that a mock class can be created or generated.

@@ special-examples/mock.php.type-errors @@

### `<<__IsFoldable>>`

If a function is marked as `<<__IsFoldable>>`, that means the function is guaranteed to have no side effects and may be called at compile-time with deterministic input.

**NOTE:** This attribute may only be used in HHVM internals and cannot be used in normal code.

### `<<__Native>>`

The `__Native` attribute specifies that an HNI extension method or function declared in a `.php` file will actually be implemented naively in C++. This attribute signals the runtime to make that hook between the user-facing declaration to the internal C++ implementation.

**NOTE:** This attribute may only be used in HHVM internals and cannot be used in normal code.

## Affects

This table lists all of the special attributes and whether or not they affect HHVM, the typechecker of both.

Attribute              | Typechecker | HHVM
-----------------------|-------------|-----
`__Override`           |    ✓        | x
`__ConsistentConstruct`|    ✓        | x
`__Memoize`            |    ✓        | ✓
`__Deprecated`         |    ✓        | ✓
`__MockClass`          |    x        | ✓
`__IsFoldable`         |    x        | ✓
`__Native`             |    x        | ✓
