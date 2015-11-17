### Async Programming in Hack

Async (asynchronous) programming is a way to have pieces of code that involve waiting (such as making a GET request to a remote web server, or database queries) run without blocking other parts of the code from executing. 

Imagine you need the result of two functions, `foo()` and `bar()`; `foo()` requires data from a web page or HTTP API, and `bar()` needs data from MySQL.

Traditionally, the execution flow will look like this:

![Synchronous execution](/images/async/feature-advert-sync.png) 

Async can lead to performance improvements by changing the flow to look like this instead:

![Asynchronous execution](/images/async/feature-advert-async.png)

### Further Reading

Our [Async Documentation](../async/introduction.md) provides more information about this feature.
