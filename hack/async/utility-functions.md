# Async Utility Functions

Async can be used effectively with the built-in infrastructure in HHVM. This infrastructure includes:

* `async`, `await`, `Awaitable`
* `HH\Asio\v()`, `HH\Asio\m()`

However, there are cases when you want to covert some collection of values to wait handles or you want to filter some wait handles out of a collection of wait handles. These type of scenarios come up when you are creating multiple wait handles to await in parallel. 

You can use functions like `array_filter()`, or the methods on the Hack collection classes, etc. to do this mapping an filtering. But there exists a whole collection of concise and simply named utility functions that will make your code more streamlined. 
