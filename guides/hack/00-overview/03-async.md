### Async Programming in Hack

Async (synchronous) programming is a way to have pieces of code that involve waiting (such as making a GET request to a remote web server, or database queries) to run without blocking other parts of the code from executing. 

Here's some non-async code that fetches two URLs:

@@ async-examples/non-async-curl.php @@

The execution flow will look like this:

![No async](/images/async/curl-synchronous.png)

This example can be modified to use Hack's async functionality:

@@ async-examples/async-curl.php @@

This leads to an execution flow like this:

![Async](/images/async/curl-async.png)

As the two HTTP requests are executing simultaneously, the total time spent can be much lower.

Our [Async Documentation](../async/introduction.md) provides more information about this feature.
