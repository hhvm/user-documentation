This will contain some helpful hints and frequently asked questions re: Hack. This is a living document and may be molded into something more user-interactive in the future.

## Async

### Is async the same as multithreading?

No. And this is important. Multithreading allows for tasks to execute in different threads of execution. Hack (and PHP) code can only run in one thread of execution. [Async](../async/introduction.md) utilizes that thread to better capacity by allowing for tasks that are stalled by some sort of process (I/O, data fetching, network) to cede control to other tasks to minimize lag. 

Normally you will have a bunch of I/O tasks batched up when using async, with results coming back faster than if they were executed one after the other in sequence. 

You are encourage to re-read the [Async introduction](/hack/async/introduction) for further clarification.

### Should I implement my own `Awaitable` class?

No. No. And no. [`Awaitable`](../async/awaitables.md) is not meant to be user-implemented. Implementing your own `Awaitable` class should only be used by the [HHVM runtime](/hhvm/) itself and those writing native extensions for HHVM.

You should, however, use `Awaitable` liberally when writing [`async`](../async/introduction.md) and let the runtime handle how it deals with awaitables.

## Collections
 
### Should I use `new` to directly instantiate a collection?

Depends, but generally not. You should use [*literal syntax*](../collections/constructing.md#literal-syntax). However, you can use [`new`](../collections/constructing.md#using-new) if and only if you are passing the constructor a `Traversable` or `null`.

### Why does `Set::values()` return a `Vector<Tv>`, but `Set::keys()` return a `Vector<mixed>`?

It is because `ConstSet` (from which `Set` ultimately derives) implements `HH\KeyedIterable<mixed, T>`. And it does this because of the `HH\KeyedIterable::map()` method. `HH\KeyedIterable::map()` specifies that it return a `KeyedIterable<Tk, Tm>`, implying different types for the keys and values. But a `Set` cannot have keys and values of different types (technically a `Set` doesn't have keys, even though it does under the covers). Since `KeyedIterable<Tk, Tm>` is not compatible with `ConstSet<Tm>`, you have to make the key aspects of `Set` be as wide as possible. 

This could be fixed in the future with changes to our collections interfaces or with advances in the typechecker.

## XHP

### I am getting `Fatal error: Class undefined` errors?

Make sure your XHP code is not in a namespace. We have issues, in many cases, using XHP in code belonging to a namespace. The issue is known and we are trying to figure out a solution.

## Other

### I am getting `Invalid argument` passing a named function as a callable?

You are probably passing it as a string, like this:

```
array_map('my-named-function', .....);
```

On its own, the Hack typechecker cannot understand what to do with a function that is referred to by its string name only. It needs some help.

In this case, you want to help the typechecker by using [`fun()`](/hack/callables/special-functions#fun) which tells the typechejcer to lookup the actual function associated with that name and typecheck that. 
