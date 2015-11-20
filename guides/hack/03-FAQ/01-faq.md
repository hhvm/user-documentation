This will contain some helpful hints and frequently asked questions re: Hack. This is a living document and may be molded into something more user-interactive in the future.

## Async

### Is async the same as multithreading?

No. And this is important. Multithreading allows for tasks to execute in different threads of execution. Hack (and PHP) code can only run in one thread of execution. [Async](../async/introduction.md) utilizes that thread to better capacity by allowing for tasks that are stalled by some sort of process (I/O, data fetching, network) to cede control to other tasks to minimize lag. 

Normally you will have a bunch of I/O tasks batched up when using async, with results coming back faster than if they were executed one after the other in sequence. 

### Should I implement my own `Awaitable` class?

No. No. And no. [`Awaitable`](../async/awaitables.md) is not meant to be user-implemented. You should use `Awaitable` liberally when writing [`async`](../async/introduction.md) and let the runtime handle how it deals with awaitables.

## Collections
 
### Should I use `new` to directly instantiate a collection?

Depends, but generally not. You should use [*literal syntax*](../collections/constructing.md#literal-syntax). However, you can use [`new`](../collections/constructing.md#using-new) if and only if you are passing the constructor a `Traversable` or `null`.

## XHP

### I am getting `Fatal error: Class undefined` errors?

Make sure your XHP code is not in namespace. We have issues, in many cases, using XHP in namespaced code. The issue is known and we are trying to figure out a solution.
