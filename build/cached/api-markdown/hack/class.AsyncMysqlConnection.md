``` yamlmeta
{
    "name": "AsyncMysqlConnection",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlConnection"
}
```




An active connection to a MySQL instance




When you call ` connect() ` with a connection provided by the pool established
with `` AsyncMysqlConnectionPool ``, you are returned this connection object to
actual do real work with the MySQL database, with the primary work being
querying the database itself.




## Interface Synopsis




``` Hack
final class AsyncMysqlConnection {...}
```




### Public Methods




+ [` ->close(): void `](</hack/reference/class/AsyncMysqlConnection/close/>)\
  Close the current connection
+ [` ->connectResult(): ?AsyncMysqlConnectResult `](</hack/reference/class/AsyncMysqlConnection/connectResult/>)\
  Returns the `` AsyncMysqlConnectResult `` for the current connection
+ [` ->escapeString(string $data): string `](</hack/reference/class/AsyncMysqlConnection/escapeString/>)\
  Escape a string to be safe to include in a raw query
+ [` ->host(): string `](</hack/reference/class/AsyncMysqlConnection/host/>)\
  The hostname associated with the current connection
+ [` ->isReusable(): bool `](</hack/reference/class/AsyncMysqlConnection/isReusable/>)\
  Returns whether or not the current connection is reusable
+ [` ->isSSL(): bool `](</hack/reference/class/AsyncMysqlConnection/isSSL/>)\
  Returns whether or not the current connection was established as SSL based
  on client flag exchanged during handshake
+ [` ->isValid(): bool `](</hack/reference/class/AsyncMysqlConnection/isValid/>)\
  Checks if the data inside `` AsyncMysqlConnection `` object is valid
+ [` ->lastActivityTime(): float `](</hack/reference/class/AsyncMysqlConnection/lastActivityTime/>)\
  Last time a successful activity was made in the current connection, in
  seconds since epoch
+ [` ->multiQuery( Traversable<string, arraykey, mixed> $queries, int $timeout_micros = -1, dict<string> $query_attributes = dict [ ]): Awaitable<Vector<AsyncMysqlQueryResult>> `](</hack/reference/class/AsyncMysqlConnection/multiQuery/>)\
  Begin running a query with multiple statements
+ [` ->port(): int `](</hack/reference/class/AsyncMysqlConnection/port/>)\
  The port on which the MySQL instance is running
+ [` ->query(string $query, int $timeout_micros = -1, dict<string> $query_attributes = dict [ ]): Awaitable<AsyncMysqlQueryResult> `](</hack/reference/class/AsyncMysqlConnection/query/>)\
  Begin running an unsafe query on the MySQL database client
+ [` ->queryf(HH\FormatString<HH\SQLFormatter> $pattern, ...$args): Awaitable<AsyncMysqlQueryResult> `](</hack/reference/class/AsyncMysqlConnection/queryf/>)\
  Execute a query with placeholders and parameters
+ [` ->releaseConnection(): mixed `](</hack/reference/class/AsyncMysqlConnection/releaseConnection/>)\
  Releases the current connection and returns a synchronous MySQL connection
+ [` ->serverInfo(): string `](</hack/reference/class/AsyncMysqlConnection/serverInfo/>)\
  The MySQL server version associated with the current connection
+ [` ->setReusable(bool $reusable): void `](</hack/reference/class/AsyncMysqlConnection/setReusable/>)\
  Sets if the current connection can be recycled without any clean up
+ [` ->sslSessionReused(): bool `](</hack/reference/class/AsyncMysqlConnection/sslSessionReused/>)\
  Returns whether or not the current connection reused the SSL session
  from another SSL connection
+ [` ->warningCount(): int `](</hack/reference/class/AsyncMysqlConnection/warningCount/>)\
  The number of errors, warnings, and notes returned during execution of
  the previous SQL statement







### Private Methods




* [` ->__construct(): void `](</hack/reference/class/AsyncMysqlConnection/__construct/>)
<!-- HHAPIDOC -->
