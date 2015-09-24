The following example shows how to use `MCRouter::flushAll` to basically flush out the memcached server of all keys and values. 

It is **imperative** to note that you must manually construct the `MCRouter` instance passing `'enable_flush_cmd' => true` as one of your options; otherwise a command disabled exception will be thrown. In other words, you cannot use `MCRouter::createSimple()` when using `flushAll`.

You can add an optional delay time in seconds to your call to `flushAll` as well.
