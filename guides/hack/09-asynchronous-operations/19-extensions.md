Async in and of itself is a highly useful construct that can provide possible time-saving through its cooperative multitasking
infrastructure. Async is especially useful with database access and caching, web resource access, and dealing with streams.

## MySQL

The async MySQL extension is similar to the [`mysqli`](http://php.net/manual/en/book.mysqli.php) extension that comes with HHVM. The async
MySQL extension is primarily used for asynchronously creating connections and querying MySQL databases.

The [full API](../reference/class/AsyncMysqlConnection/) contains all of the classes and methods available for accessing MySQL via async; we
will only cover a few of the more common scenarios here.

The primary class for connecting to a MySQL database is [`AsyncMysqlConnectionPool`](../reference/class/AsyncMysqlClient/) and its
primary method is the `async` [`connect`](../reference/class/AsyncMysqlClient/connect/).

The primary class for querying a database is [`AsyncMysqlConnection`](../reference/class/AsyncMysqlConnection/) with the two main
query methods, [`query`](../reference/class/AsyncMysqlConnection/query/) and [`queryf`](../reference/class/AsyncMysqlConnection/queryf/),
both od which are `async`. There is also a function to ensure that queries to be executed are safe called
[`escapeString`](../reference/class/AsyncMysqlConnection/escapeString/).

The primary class for retrieving results from a query is an abstract class called `AsyncMysqlResult`, which itself has two concrete
subclasses called [`AsyncMysqlQueryResult`](../reference/class/AsyncMysqlQueryResult/) and
[`AsyncMysqlErrorResult`](../reference/class/AsyncMysqlErrorResult/). The main methods on these classes are
[`vectorRows`](../reference/class/AsyncMysqlQueryResult/vectorRows/) and [`mapRows`](../reference/class/AsyncMysqlQueryResult/mapRows/), both *non-async*.

Here is a simple example that shows how to get a user name from a database using this extension:

@@ extensions-examples/async-mysql.php @@

### Connection Pools

The async MySQL extension does *not* support multiplexing; each concurrent query requires its own connection. However, the extension
does support connection pooling.

The async MySQL extension provides a mechanism to pool connection objects so we don't have to create a new connection every time we
want to make a query. The class is [`AsyncMysqlConnectionPool`](../reference/class/AsyncMysqlConnectionPool/) and one can be created like this:

@@ extensions-examples/async-mysql-connection-pool.php @@

It is ***highly recommended*** that connection pools are used for MySQL connections; if for some reason we really need one, single asynchronous
client, there is an [`AsyncMysqlClient`](../reference/class/AsyncMysqlClient/) class that provides a
[`connect`](../reference/class/AsyncMysqlClient/connect/) method.

## MCRouter

MCRouter is a memcached protocol-routing library. To help with  [memcached](http://php.net/manual/en/book.memcached.php) deployment, it
provides features such as connection pooling and prefix-based routing.

The async MCRouter extension is basically an async subset of the Memcached extension that is part of HHVM. The primary class is
[`MCRouter`](../reference/class/MCRouter/). There are two ways to create an instance of an MCRouter object. The
[`createSimple`](../reference/class/MCRouter/createSimple/) method takes a vector of server addresses where memcached is running. The
more configurable [`__construct`](../reference/class/MCRouter/__construct/) method allows for more option tweaking. After getting an object,
we can use the `async` versions of the core memcached protocol methods like [`add`](../reference/class/MCRouter/add/),
[`get`](../reference/class/MCRouter/get/) and [`del`](../reference/class/MCRouter/del/).

Here is a simple example showing how one might get a user name from memcached:

@@ extensions-examples/async-mcrouter.php @@

If an issue occurs when using this protocol, two possible exceptions can be thrown: `MCRouterException` when something goes wrong with
a core option, like deleting a key; `MCRouterOptionException` when the provide option list can't be parsed.

## cURL

Hack currently provides two async functions for [cURL](http://curl.haxx.se/).

### `curl_multi_await`

cURL provides a data transfer library for URLs. The async cURL extension provides two functions, one of which is a wrapper around the
other. `curl_multi_await` is the async version of HHVM's `curl_multi_select`. It waits until there is activity on the cURL handle and
when it completes, we use `curl_multi_exec` to process the result, just as we would in the non-async situation.

```Hack
async function curl_multi_await(resource $mh, float $timeout = 1.0): Awaitable<int>;
```

### `curl_exec`

The function `HH\Asio\curl_exec` is a wrapper around `curl_multi_await`. It is easy to use as we don't necessarily have to worry about
resource creation since we can just pass a string URL to it.

```Hack
namespace HH\Asio {
  async function curl_exec(mixed $urlOrHandle): Awaitable<string>;
}
```

Here is an example of getting a vector of URL contents, using a lambda expression to cut down on the code verbosity that would come with
full closure syntax:

@@ extensions-examples/async-curl.php @@

## Streams

The async stream extension has one function, [`stream_await`](../reference/function/stream_await/), which is functionally similar
to HHVM's [`stream_select`](http://php.net/manual/en/function.stream-select.php). It waits for a stream to enter a state (e.g.,
`STREAM_AWAIT_READY`), but without the multiplexing functionality of [`stream_select`](http://php.net/manual/en/function.stream-select.php). We
can use [HH\Lib\Vec\from_async](../reference/function/HH.Lib.Vec.from_async/) to await multiple stream handles, but the resulting combined awaitable won't be complete
until all of the underlying streams have completed.

```Hack
async function stream_await(resource $fp, int $events, float $timeout = 0.0): Awaitable<int>;
```

The following example shows how to use [`stream_await`](../reference/function/stream_await/) to write to resources:

@@ extensions-examples/async-stream.php @@
