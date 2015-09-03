# Async Extensions

Async in and of itself is a highly useful construct that will provide possible time-saving through its cooperative multitasking infrastructure. However, we knew there would be a common set of functionality where async would be most useful: database access and caching, web resource access, and streams.

## MySQL

*TL;DR*: Go straight to the [**MySQL API Reference**](link to the MySQL API)

The async MySQL extension is similar to the [`mysqli`](link to mysqli) extension that comes with HHVM. This extension will be primarily used for asynchronously creating connections and querying MySQL databases. 

The [full API](link to MySQL API) will contain all of the classes and methods available for accessing MySQL via async; we will cover a few of the more common scenarios here.

The primary class for connecting to a MySQL database is `AsyncMysqlClient` and its primary method is the *async* `connect()`. The primary class for querying a database is `AsyncMysqlConnection` with the two main query methods, `query()` and `queryf()`, both *async*. The primary class for retrieving results from a query is an abstract class called `AsyncMysqlResult`, which itself has two concrete subclasses called `AsyncMysqlQueryResult` and `AsyncMysqlErrorResult`. The main methods on these classes are `vectorRows()` and `mapRows()`, both *non-async*.

```
<?hh
class AsyncMysqlClient {
  public static async function connect(
    string $host,
    int $port,
    string $dbname,
    string $user,
    string $password,
    int $timeout_micros = -1): Awaitable<?AsyncMysqlConnection>;
  // More methods in this class, of course
}

class AsyncMysqlConnection {
  public function query(string $query, int $timeout_micros)
    : Awaitable<AsyncMysqlResult>;
  public function queryf(string $pattern, ..$args)
    : Awaitable<AsyncMysqlResult>;
  // More methods in this class, of course
}

class AsyncMysqlQueryResult extends AsyncMysqlResult {
  public function vectorRows(): Vector; // vector of Vectors
  public function mapRows(): Vector; // vector of Maps
  // return db column values as Hack types instead of
  // string representations of those types.
  public function vectorRowsTyped(): Vector;
  public function mapRowsTyped(): Vector;
  // More methods in this class, of course
}

class AsyncMysqlErrorResult extends AsyncMysqlResult {
  public function failureType(): string;
  public function mysql_errno(): int;
  public function mysql_error(): string;
  // More methods in this class, of course
}
```

Here is a simple example that shows how to get a user name from a database with this extension.

@@ extensions-examples/async-mysql.php @@

### Connection Pools

The async MySQL extension **does not** support multiplexing -- each concurrent query requires its own connection. However, the extension does support connection pooling.

The async MySQL extension provides a mechanism to pool connection objects so you don't have to create a new connection every time you want to make a query. The class is `AsyncMysqlConnection` and one can be created like this:

@@ extensions-examples/async-mysql-connection-pool.php @@

## MCRouter

*TL;DR*: Go straight to the [**McRouter API Reference**](link to the McRouter API)

MCRouter is a memcached protocol routing library. To help your [memcached](link to memcached) memcached deployment, it provides features like connection pooling, prefix-based routing, etc.

The async MCRouter extension is basically an async, yet subset, version of the Memcached extension that is part of HHVM. The primary class is `MCRouter`. There are two ways to create an instance of an MCRouter object. The `createSimple()` takes a vector of server addresses where memcached is running. The more configurable `__construct()` allows for more option tweaking. After getting an object, you can use the *async* versions of the core memcached protocol methods like `add()`, `get()` and `del()`.

```
class MCRouter {
  public function __construct(array<stirng, mixed> $options, string $pid = '');
  public static function createSimple(ConstVector<string> $servers): MCRouter;
  public async function add(string $key, string $value, int $flags = 0, 
                            int $expiration = 0): Awaitable<void>;
  public async function get(string $key): Awaitable<string>;
  public async function del(string $key): Awaitable<void>;
  // More methods exist, of course
}
```

Here is a simple example showing how one might get a user name from memcached:

@@ extensions-examples/async-mcrouter.php @@

If an issue occurs when using this protocol, two possible exceptions can be thrown. `MCRouterException` is thrown when something goes wrong with a core option, like deleting a key. `MCRouterOptionException` occurs when you provide an non-parsable option list.

## cURL

*TL;DR*: Go straight to the [**cURL API Reference**](link to the cURL API)

cURL provides a data transfer library for URLs. The async cURL extension provides two functions, one of which is a wrapper around the other. `curl_multi_await()` is the async version of HHVM's [`curl_multi_select()`](link to curl_multi_select). It waits until there is activity on the cURL handle and when it completes you use [`curl_multi_exec()`](link to curl_multi_exec) to process the result, just as you would in the non-async situation. `HH\Asio\curl_exec()` is a wrapper around `curl_multi_await()`. It is easy to use as you don't necessarily have to worry about resource creation since you can just pass a string URL to it.

```
async function curl_multi_await(resource $mh, 
                                float $timeout = 1.0): Awaitable<int>;
namespace HH\Asio {
  async function curl_exec(mixed $urlOrHandle): Awaitable<string>;
}
```

Here is an example of getting a vector of URL contents, using a [lambda](link to lambdas) to cut down on the code verbosity that would come with full closure syntax.

@@ extensions-examples/async-curl.php @@

## Streams  

*TL;DR*: Go straight to the [**Streams API Reference**](link to the Streams API)

The async stream extension has one function, `stream_await()`, which is functionally similar to HHVM's [`stream_select()`](link to stream_select). It waits for a stream to enter a state (e.g., `STREAM_AWAIT_READY`), but without the multiplexing functionality of `stream_select()`. You can use HH\Asio\v() to await multiple stream handles, but the resulting combined wait handle won't be complete until all of the underlying streams have completed.

```
async function stream_await(resource $fp, int $events, 
                            float $timeout = 0.0): Awaitable<int>;
```

This example shows how you can use `stream_await()` to write to resources

@@ extensions-example/async-stream.php @@
