# Async

Hack and PHP do not natively support multithreaded programming. However, one can envision many scenarios where such a capability might be useful. Common examples being executing two or more heavy computations; or making two or more web or database queries. 

One could easily expect that the following two calls are unrelated and could be run independent of each other. 

@@ intro-examples/non-async-curl.php @@

In the example above, the call to `curl_exec` in `curl_A()` is blocking any other processing. Thus, even though `curl_B()` is an independent call from `curl_A()`, it has to sit around waiting for `curl_A()` to finish before beginning its execution.

![No Async](/images/no-async.png)

Hack provides a feature called **async** that provides your program the benefit of cooperative multi-tasking. Async is **not multithreading**. It allows code that utilizes the async infrastructure to hide input/output (I/O) latency and data fetching. So, if you have code that has operations that involve some sort of waiting (e.g., network access, waiting for database queries), async minimizes the downtime your program has to be stalled because of it as the program will go do other things, most likely further I/O somewhere else.

The following images should hopefully clear up any confusion you may have on what async is. Let's assume you have three distinct tasks to execute (don't worry about what the tasks are):

** Synchronous Execution **

This is just like PHP and Hack (without async) is executed today. Serial execution.

![Synchronous](/images/synchronous.png)

** Parallel Execution **

This is an optimum state. We have all tasks running at the same time, concurrently. But, PHP and Hack do not support more than one thread of execution.

![Parallel](/images/parallel.png)

** Asynchronous Execution **

This is what async does. Tasks are executed concurrently in the same execution thread, with respect to each other, interleaving instructions (e.g., I/O) for different tasks back and forth.

![Asynchronous](/images/asynchronous.png)

**IMPORTANT**: It is important to reiterate that async is not multithreading. You are still bound to a single execution thread. Async works best when you have a lot of I/O codepaths that don't have to sit there waiting for other I/O requests to end to begin doing their requests.

@@ intro-examples/async-curl.php @@

In this example, we are calling an async-aware version of `curl_exec()`. Thus, in this case, our waiting state is explicitly allowing other I/O operation tasks in the code to occur.

When `curl_A()` hits a call to `HH\Asio\curl_exec`, depending on, for example, the network latency to retrieve results of the CURL, the async infrastructure (the scheduler) looks for other async tasks that could be run. It finds that `curl_B()` is available to execute, so it starts executing that code. When it hits its `HH\Asio\curl_exec()` call, the process is repeated again, and the scheduler will find that our `curl_exec()` call in `curl_B()` is ready for execution once again.

![Async](/images/async.png) 

While this example may not always show a measurable time savings (there are some factors like network latency and possible caching involved), but you will not be slower than the non-async version overall and you may get results like this:

*Non-Async*
```
Total time taken: 3.3065688610077 seconds
```

*Async*
```
Total time taken: 2.3396739959717 seconds
```

The keys to async are [awaitables](awaitables.md), which activate the internal HHVM async scheduler, and being able to organize your code to minimize data dependencies and follow general [guidelines](guidelines.md).

NOTE: While executing two async functions can utilize cooperative multi-tasking described here, if those async functions call blocking functions like [`curl_exec()`](php.net/manual/en/function.curl-exec.php) or `sleep()`[php.net/manual/en/function.sleep.php], those blocking calls are not cooperatively multi-tasking and will be blocked as normal.
