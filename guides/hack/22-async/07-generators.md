[Generators](http://php.net/manual/en/language.generators.overview.php) provide a more compact way to write an [iterator](http://php.net/manual/en/language.oop5.iterations.php). Generators work by passing control back and forth between the generator and the calling code. Instead of returning once or requiring something that could be memory intensive like an array, generators yield values to the calling code as many times as necessary in order to provide the values being iterated over. 

Generators can be `async` functions; an async generator behaves similarly to a normal generator except that each yielded value is an [`Awaitable`](/hack/async/awaitables) that is `await`ed upon.

## Async Iterators 

To yield values or key/value pairs from async generators, you return [HH\AsyncIterator](/hack/reference/interface/HH.AsyncIterator/) or [HH\AsyncKeyedIterator](/hack/reference/interface/HH.AsyncKeyedIterator/), respectively.

Here is an example of using the [async utility function](/hack/async/utility-functions) [`usleep()`](/hack/reference/function/HH.Asio.usleep/) to imitate a second-by-second countdown clock. Note that in the `happy_new_year()` `foreach` loop we have the syntax `await as`. This is shorthand for calling `await $ait->next()`.

@@ generators-examples/iterator.php @@

You have to `await` calls to `next()` (or when using `await as`); otherwise you will not get the iterated value. And unlike the `next()` method on normal iterators, a call to `next()` on an async iterator actually returns a value (instead of `void`).

## Sending and Raising

You can send a value to a generator using `send()` and raise an exception upon a generator using `raise()`. 

If you are doing either of these two things, your generator must return `AsyncGenerator`. An `AsyncGenenator` has three type parameters. The first is the key. The second is the value. The third is the type being passed to `send()`.

@@ generators-examples/send.php @@

Here is how to raise an exception to an async generator.

@@ generators-examples/raise.php @@
