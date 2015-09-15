# Async

Hack and PHP do not natively support multithreaded programming. However, one can envision many scenarios where such a capability might be useful. Common examples being executing two or more heavy computations; or making two or more web or database queries. 

One could easily expect that the following two calls are unrelated and could be run independent of each other. 

@@ intro-examples/non-async-curl.php @@

In the example above, the call to `curl_exec` in `curl_A()` is blocking any other processing. Thus, even though `curl_B()` is an independent call from `curl_A()`, it has to sit around waiting for `curl_A()` to finish before beginning its execution.

![No Async](images/no-async.png)

Hack provides a feature called **async** that provides your program the benefit of cooperative multi-tasking. While not true multithreading, this is the next best thing. It allows code that utilizes the async infrastructure to cede CPU time to one another in an explicit and knowing fashion. So, if you have code that has operations that involve some sort of waiting (e.g., network access), async minimizes the downtime your program has to be stalled because of it.

@@ intro-examples/async-curl.php @@

In this example, we are calling an async-aware version of `curl_exec()`. Thus, in this case, our waiting state is explictly allowing control of the CPU to other tasks in the code.

When `curl_A()` hits a call to `HH\Asio\curl_exec`, depending on, for example, the network latency to retrieve results of the CURL, the async infrastructure (the scheduler) looks for other async tasks that could be run. It finds that `curl_B()` is available to execute, so it starts executing that code. When it hits its `HH\Asio\curl_exec()` call, the process is repeated again, and the scheduler will find that our `curl_exec()` call in `curl_B()` is ready for execution once again.

![Async](images/async.png) 

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
