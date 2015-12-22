It might be tempting to just throw `async`, `await` and `Awaitable` on all your code and go on with your life. And while it is OK to have more `async` functions than not -- in fact, you should generally not be afraid to make a function `async` since there is no performance penalty for doing so -- there are some guidelines you should follow in order to make the most efficient use of `async`.

## Be Liberal, but Careful, with Async

If you are struggling as to whether your code should be async or not, you can generally start with the answer *yes* and find a reason to say *no*. For example, a simple *hello world* program can be made async with no performance penalty. You will likely not get any gain, but you will not get any loss -- and it is setup for any future changes that may require async.

These two programs are, for all intents and purposes, equivalent.

@@ guidelines-examples/non-async-hello.php @@

@@ guidelines-examples/async-hello.php @@

Just make sure you are following the rest of the guidelines. Async is great, but you still have to consider things like caching, batching and efficiency.

## Use Async Extensions

For the common cases where async would provide maximum benefit, HHVM provides convenient extension libraries to help make writing code much easier. Depending on your use case scenario, you should liberally use:

* [MySQL](./extensions.md#mysql) for database access and queries.
* [cURL](./extensions.md#curl) for web page data and transfer.
* [McRouter](./extensions.md#mcrouter) for memcached-based operations.
* [Streams](./extensions.md#streams) for stream-based resource operations.

## Do Not Use Async in Loops

If you only remember one rule, remember this:

** DON'T `await` IN A LOOP **

It totally defeats the purpose of async. 

@@ guidelines-examples/await-loop.php @@

In the above example, the loop is doing two things: 

1. Making the loop iterations the limiting factor on how this code is going to run. By the loop, you are guaranteed to get the users sequentially.
2. You are creating false dependencies. Loading one user is not dependent on loading another user.

Instead, you will want to use our async-aware mapping function, `vm()`.

@@ guidelines-examples/await-no-loop.php @@

## Considering Data Dependencies Is Important

Possibly the most important aspect in learning how to structure async code is understanding data dependency patterns. Here is the general flow of how to make sure your async code is data dependency correct:

1. Put each sequence of dependencies with no branching (chain) into its own `async` function.
2. Put each bundle of parallel chains into its own `async` function.
3. Repeat to see if there are further reductions.

Let's say we are getting blog posts of an author. This would involve the following steps:

1. Get the post ids for an author.
2. Get the post text for each post id.
3. Get comment count for each post id.
4. Generate final page of information

@@ guidelines-examples/data-dependencies.php @@

The above example follows our flow:

1. One function for each fetch operation (post ids, post text, comment count).
2. One function for the bundle of data operations (post text and comment count).
3. One top function that coordinates everything.

## Consider Batching

Wait handles can be rescheduled. This means that it will be sent back to the queue of the scheduler, waiting until other awaitables have run. Batching can be a good use of rescheduling. For example, say you have high latency lookup of data, but you can send multiple keys for the lookup in a single request.

@@ guidelines-examples/batching.php @@

In the example above, we reduce the number of roundtrips to the server containing the data information to two by batching the first lookup in `b_one()` and the lookup in `b_two()`. The `Batcher::lookup()` function helps enable this reduction.

The `await HH\Asio\later()` in `Batcher::go()` basically allows `Batcher::go()` to be deferred until other pending awaitables have run.

So, `await HH\Asio\v(array(b_one..., b_two...));` has two pending awaitables. If `b_one()` is called first, it calls `Batcher::lookup()`, which calls `Batcher::go()`, which reschedules via `later()`. Then HHVM looks for other pending awaitables. `b_two()` is also pending. It calls `Batcher::lookup()` and then it gets suspended via `await self::$aw` because `Batcher::$aw` is not `null` any longer. Now `Batcher::go()` resumes, fetches and returns the result.

## Don't Forget to Await an Awaitable

What do you think happens here?

@@ guidelines-examples/forget-await.php @@

The answer is undefined. You might get all three echoes. You might only get the first echo. You might get nothing at all. The only way to guarantee that `speak()` will run to completion is to `await` it. `await` is the trigger to the async scheduler that allows HHVM to appropriately suspend and resume `speak()`; otherwise, the async scheduler will be provide no guarantees with respect to `speak()`.

## Minimize Undesired Side Effects

In order to minimize any unwanted side effects (e.g., ordering disparities), your creation and awaiting of awaitables should happen as close as possible.

@@ guidelines-examples/side-effects.php @@

In the above example, `possible_side_effects()` could cause some undesired behavior when you get to the point of awaiting the handle associated with getting the data from the website.

Basically, don't depend on the order of output between runs of the same code. i.e, don't write async code where ordering is important and instead use dependencies via awaitables and `await`.

## Memoization May Be Good. But Only Awaitables

Given that async is commonly used in operations that are time-consuming, memoizing (i.e., caching) the result of an async call can definitely be worthwhile.

The [`<<__Memoize>>`](../attributes/special.md#__memoize) attribute does the right thing. So, if you can, use that. However, if you need explicit control of the memoization, make sure you *memoize the awaitable* and not the result of awaiting it.

@@ guidelines-examples/memoize-result.php @@

On the surface, this seems reasonable. We want to cache the actual data associated with the awaitable. However, this can cause an undesired race condition.

Imagine that there are two other async functions awaiting the result of `memoize_result()`, call them `A()` and `B()`.  The following sequence of events can happen:

1. `A()` gets to run, and `await`s `memoize_result()`.
2. `memoize_result()` finds that the memoization cache is empty (`$result` is
`null`), so it `await`s `time_consuming()`. It gets suspended.
3. `B()` gets to run, and `await`s `memoize_result()`. Note that this is a new awaitable; it’s not the same awaitable as in 1.
4. `memoize_result()` again finds that the memoization cache is empty, so it
awaits `time_consuming()` again. Now the time-consuming operation will be done twice. 

If `time_consuming()` has side effects (e.g. a database write), then this could end up being a serious bug. Even if there are no side effects, it’s still a bug; the time-consuming operation is being done multiple times when it only needs to be done once.

Instead, memoize the awaitable:

@@ guidelines-examples/memoize-awaitable.php @@

This simply caches the handle and returns it verbatim - [Async Vs Awaitable](async-vs-awaitable.md) explains this in more detail.

This would also work if it were an async function that awaited the handle after caching. This may seem unintuitive, because the function `await`s every time it’s executed, even on the cache-hit path. But that’s fine: on every execution except the first, `$handle` is not `null`, so a new instance of `time_consuming()` will not be started. The result of the one existing instance will be shared.

Either approach works, but the non-async caching wrapper can be easier to reason about.

## Use Lambdas Where Possible

[Lambdas](../lambdas/introduction.md) can cut down on code verbosity that comes with writing full closure syntax. They are quite useful in conjunction with the [async utility helpers](utility-functions.md). 

For example, look how the following three ways to accomplish the same thing can be shortened using lambdas.

@@ guidelines-examples/lambdas.php @@

## Use `join` in Non-async Functions

Imagine you are making a call to an `async` function `join_async()` from a non-async scope. In order to obtain your desired results, you must `join()` in order to get the result from an awaitable. 

@@ guidelines-examples/join.php @@

This scenario normally occurs in the global scope (but can occur anywhere).

## Remember Async Is NOT Multi-threading

Async functions are not running at the same time. They are CPU sharing via changes in wait state in executing code (i.e., preemptive multitasking). Async still lives in the single-threaded world of normal PHP and Hack.

## `await` Is Not an Expression

You can use `await` in three places:

1. As a statement by itself (e.g., `await func()`)
2. On the right-hand side (RHS) of an assignment (e.g., `$r = await func()`)
3. As an argument to `return` (e.g., `return await func()`)

You cannot, for example, use `await` in `var_dump()`.
