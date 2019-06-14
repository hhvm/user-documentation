[Generators](http://php.net/manual/en/language.generators.overview.php) provide a more compact way to write an
[iterator](http://php.net/manual/en/language.oop5.iterations.php). Generators work by passing control back and forth between the
generator and the calling code. Instead of returning once or requiring something that could be memory-intensive like an array, generators
yield values to the calling code as many times as necessary in order to provide the values being iterated over.

Generators can be `async` functions; an async generator behaves similarly to a normal generator except that each yielded value is an
`Awaitable` that is `await`ed upon.

## Async Iterators

To yield values or key/value pairs from async generators, we return [HH\AsyncIterator](/hack/reference/interface/HH.AsyncIterator/) or
[HH\AsyncKeyedIterator](/hack/reference/interface/HH.AsyncKeyedIterator/), respectively.

Here is an example of using the [async utility function](../asynchronous-operations/utility-functions.md)
[`usleep`](/hack/reference/function/HH.Asio.usleep/) to imitate a second-by-second countdown clock. Note that in the
`happy_new_year` `foreach` loop we have the syntax `await as`. This is shorthand for calling `await $ait->next()`.

@@ generators-examples/iterator.php @@

We must use `await as`; otherwise we'll not get the iterated value.

Although `await as` is just like calling `await $gen->next()`, we should always use `await as`. Calling the
[`AsyncGenerator`](/hack/reference/class/HH.AsyncGenerator/) methods directly is rarely needed. Also note that on async iterators,
`await as` or a call to [`next`](/hack/reference/class/HH.AsyncGenerator/next/) actually returns a value (instead of `void` like in a normal iterator).

## Sending and Raising

**Calling these methods directly should be rarely needed; `await as` should be the most common way to access values returned by an iterator.**

We can send a value to a generator using [`send`](/hack/reference/class/HH.AsyncGenerator/send/) and raise an exception upon a
generator using [`raise`](/hack/reference/class/HH.AsyncGenerator/raise/).

If we are doing either of these two things, our generator must return `AsyncGenerator`. An `AsyncGenenator` has three type
parameters: the key, the value. And the type being passed to [`send`](/hack/reference/class/HH.AsyncGenerator/send/).

@@ generators-examples/send.php @@

Here is how to raise an exception to an async generator.

@@ generators-examples/raise.php @@
