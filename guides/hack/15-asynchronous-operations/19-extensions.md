Async in and of itself is a highly useful construct that can provide possible time-saving through its cooperative multitasking
infrastructure. Async is especially useful with database access and caching, web resource access, and dealing with streams.

## MySQL

The async MySQL extension is a built-in way to execute queries against databases while running Hack code when the database is processing.
The async MySQL extension is primarily used for asynchronously creating connections and querying MySQL databases.

The [full API](../reference/class/AsyncMysqlConnection/) contains all of the classes and methods available for accessing MySQL via async; we
will only cover a few of the more common scenarios here.

The primary class for connecting to a MySQL database is [`AsyncMysqlConnectionPool`](../reference/class/AsyncMysqlClient/) and its
primary method is the `async` [`connect`](../reference/class/AsyncMysqlClient/connect/).

The primary class for querying a database is [`AsyncMysqlConnection`](../reference/class/AsyncMysqlConnection/) with the three main query methods:
[`query`](../reference/class/AsyncMysqlConnection/query/),
[`queryf`](../reference/class/AsyncMysqlConnection/queryf/), and
[`queryAsync`](../references/class/AsyncMysqlConnection/queryAsync)
all of which are `async`. The naming conventions for async method have not been applied consistently.
There is also a function to ensure that queries to be executed are safe called
[`escapeString`](../reference/class/AsyncMysqlConnection/escapeString/).

## Choosing a query method

Choosing the right tool for the job is very important.
Each of the three methods has its strengths and weaknesses.

### [`queryf`](../reference/class/AsyncMysqlConnection/queryf/)
This should be your preferred method. It is powerful enough to express all queries with a known structure, but with unknown data.

For example:
 - selecting a post by ID
 - selecting the post with the most likes made within the last _n_ days by user _x_
 - updating all profiles from users who have been active in the last _n_ days by giving them a badge

### [`queryAsync`](../references/class/AsyncMysqlConnection/queryAsync)
This method is a lot more powerful than `queryf` and should be used when the structure of your query is not known in advance. The `%Q` modifier can be used to insert query fragments into other query fragments.

For example:
 - Advanced search, which may allow the user to specify a handful of parameters
 - Inserting _n_ rows in one big INSERT INTO statement

### [`query`](../reference/class/AsyncMysqlConnection/query/)
This method is **dangerous** when used wrong. It accepts a _raw string_ and passes it to the database without scanning for dangerous characters or doing any automatic escaping.
If your query contains ANY unescaped input, you are putting your database at risk.

Using this method is preferred for one use case:

When you can type out the query outright, without string interpolation or string concatenation.
You can pass in a "hardcoded" query. This can be preferred over queryf, since you can write your SQL string literals without having to write a `%s` placeholder. Which makes it easier to change the query later without the risk of messing up which parameter goes with which `%s`.

This method can also be used to create queries by doing string manipulation. If you are doing this, you, the developer, must take responsibility for sanitizing the data. Escape everything that needs to be escaped and make triple sure there is not a sneaky way to get raw user data into the concatenated string at any point. As said, this method is dangerous and this is why.

## Getting results
The primary class for retrieving results from a query is an abstract class called `AsyncMysqlResult`, which itself has two concrete
subclasses called [`AsyncMysqlQueryResult`](../reference/class/AsyncMysqlQueryResult/) and
[`AsyncMysqlErrorResult`](../reference/class/AsyncMysqlErrorResult/). The main methods on these classes are
[`vectorRows`](../reference/class/AsyncMysqlQueryResult/vectorRows/) | [`vectorRowsTyped`](../reference/class/AsyncMysqlQueryResult/vectorRowsTyped/) and [`mapRows`](../reference/class/AsyncMysqlQueryResult/mapRows/) | [`mapRowsTyped`](../reference/class/AsyncMysqlQueryResult/mapRowsTyped/), which are *non-async*.

### When to use the `____Typed` variant over its untyped counterpart.

The typed functions will help you by turning database integers into Hack `int`s and _some, but not all_ fractional numbers into Hack `float`s.
The untyped function will return all fields as either a Hack `string` or a Hack `null`. So an integer `404` in the database would come back as `"404"`.

Here is a simple example that shows how to get a user name from a database using this extension:

```async-mysql.hack
use \Hack\UserDocumentation\API\Examples\AsyncMysql\ConnectionInfo as CI;

async function get_connection(): Awaitable<\AsyncMysqlConnection> {
  // Get a connection pool with default options
  $pool = new \AsyncMysqlConnectionPool(darray[]);
  // Change credentials to something that works in order to test this code
  return await $pool->connect(
    CI::$host,
    CI::$port,
    CI::$db,
    CI::$user,
    CI::$passwd,
  );
}

async function fetch_user_name(
  \AsyncMysqlConnection $conn,
  int $user_id,
): Awaitable<?string> {
  // Your table and column may differ, of course
  $result = await $conn->queryf(
    'SELECT name from test_table WHERE userID = %d',
    $user_id,
  );
  // There shouldn't be more than one row returned for one user id
  invariant($result->numRows() === 1, 'one row exactly');
  // A vector of vector objects holding the string values of each column
  // in the query
  $vector = $result->vectorRows();
  return $vector[0][0]; // We had one column in our query
}

async function get_user_info(
  \AsyncMysqlConnection $conn,
  string $user,
): Awaitable<Vector<Map<string, ?string>>> {
  $result = await $conn->queryf(
    'SELECT * from test_table WHERE name = %s',
    $conn->escapeString($user),
  );
  // A vector of map objects holding the string values of each column
  // in the query, and the keys being the column names
  $map = $result->mapRows();
  return $map;
}

<<__EntryPoint>>
async function async_mysql_tutorial(): Awaitable<void> {
  $conn = await get_connection();
  if ($conn !== null) {
    $result = await fetch_user_name($conn, 2);
    \var_dump($result);
    $info = await get_user_info($conn, 'Fred Emmott');
    \var_dump($info is vec<_>);
    \var_dump($info[0] is dict<_, _>);
  }
}
```.example.hhvm.out
string(11) "Fred Emmott"
bool(true)
bool(true)
```.hhvm.expectf
string(%d) "%s"
bool(true)
bool(true)
```.skipif
await \Hack\UserDocumentation\API\Examples\AsyncMysql\skipif_async();
```

### Connection Pools

The async MySQL extension does *not* support multiplexing; each concurrent query requires its own connection. However, the extension
does support connection pooling.

The async MySQL extension provides a mechanism to pool connection objects so we don't have to create a new connection every time we
want to make a query. The class is [`AsyncMysqlConnectionPool`](../reference/class/AsyncMysqlConnectionPool/) and one can be created like this:

```async-mysql-connection-pool.hack
use \Hack\UserDocumentation\API\Examples\AsyncMysql\ConnectionInfo as CI;

function get_pool(): \AsyncMysqlConnectionPool {
  return new \AsyncMysqlConnectionPool(
    darray['pool_connection_limit' => 100],
  ); // See API for more pool options
}

async function get_connection(): Awaitable<\AsyncMysqlConnection> {
  $pool = get_pool();
  $conn = await $pool->connect(
    CI::$host,
    CI::$port,
    CI::$db,
    CI::$user,
    CI::$passwd,
  );
  return $conn;
}

<<__EntryPoint>>
async function run(): Awaitable<void> {
  $conn = await get_connection();
  \var_dump($conn);
}
```.hhvm.expect
object(AsyncMysqlConnection) (0) {
}
```.skipif
await \Hack\UserDocumentation\API\Examples\AsyncMysql\skipif_async();
```

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

```async-mcrouter.hack
function get_mcrouter_object(): \MCRouter {
  $servers = Vector {\getenv('HHVM_TEST_MCROUTER')};
  $mc = \MCRouter::createSimple($servers);
  return $mc;
}

async function add_user_name(
  \MCRouter $mcr,
  int $id,
  string $value,
): Awaitable<void> {
  $key = 'name:'.$id;
  await $mcr->set($key, $value);
}

async function get_user_name(\MCRouter $mcr, int $user_id): Awaitable<string> {
  $key = 'name:'.$user_id;
  try {
    $res = await \HH\Asio\wrap($mcr->get($key));
    if ($res->isSucceeded()) {
      return $res->getResult();
    }
    return "";
  } catch (\MCRouterException $ex) {
    echo $ex->getKey().\PHP_EOL.$ex->getOp();
    return "";
  }
}

<<__EntryPoint>>
async function run(): Awaitable<void> {
  $mcr = get_mcrouter_object();
  await add_user_name($mcr, 1, 'Joel');
  $name = await get_user_name($mcr, 1);
  \var_dump($name); // Should print "Joel"
}
```.example.hhvm.out
string(4) "Joel"
```.hhvm.expectf
string(%d) "%s"
```.skipif
\Hack\UserDocumentation\API\Examples\MCRouter\skipif();
```

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

```async-curl.hack
function get_urls(): vec<string> {
  return vec[
    "http://example.com",
    "http://example.net",
    "http://example.org",
  ];
}

async function get_combined_contents(
  vec<string> $urls,
): Awaitable<vec<string>> {
  // Use lambda shorthand syntax here instead of full closure syntax
  $handles = \HH\Lib\Vec\map_with_key(
    $urls,
    ($idx, $url) ==> \HH\Asio\curl_exec($url),
  );
  $contents = await \HH\Lib\Vec\from_async($handles);
  echo \HH\Lib\C\count($contents)."\n";
  return $contents;
}

<<__EntryPoint>>
function main(): void {
  \HH\Asio\join(get_combined_contents(get_urls()));
}
```

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

```async-stream.hack
function get_resources(): vec<resource> {
  $r1 = \fopen('php://stdout', 'w');
  $r2 = \fopen('php://stdout', 'w');
  $r3 = \fopen('php://stdout', 'w');

  return vec[$r1, $r2, $r3];
}

async function write_all(vec<resource> $resources): Awaitable<void> {
  $write_single_resource = async function(resource $r) {
    $status = await \stream_await($r, \STREAM_AWAIT_WRITE, 1.0);
    if ($status === \STREAM_AWAIT_READY) {
      \fwrite($r, \str_shuffle('ABCDEF').\PHP_EOL);
    }
  };
  // You will get 3 shuffled strings, each on a separate line.
  await Vec\from_async(\array_map($write_single_resource, $resources));
}

<<__EntryPoint>>
function main(): void {
  \HH\Asio\join(write_all(get_resources()));
}
```.hhvm.expectf
%s
%s
%s
```
