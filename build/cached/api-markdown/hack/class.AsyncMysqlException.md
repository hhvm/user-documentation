``` yamlmeta
{
    "name": "AsyncMysqlException",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql_exceptions.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlException"
}
```




The base exception class for any issues arising from the use of async
MySQL




In general, when trying to connect to a MySQL client (e.g., via
` AsyncMysqlConnectionPool::connect() `) or when making a query (e.g., via
`` AsyncMysqlConnection::queryf() ``), it is good practice to have your code
exception catchable somewhere in the code pipeline (via
[try/catch](<http://php.net/manual/en/language.exceptions.php>)).




e.g.,




```
try {
  // code here
} catch (AsyncMysqlException $ex) {
  $error = $ex->mysqlErrorString();
}
```




## Interface Synopsis




``` Hack
class AsyncMysqlException extends Exception {...}
```




### Public Methods




+ [` ->__construct(AsyncMysqlErrorResult $result) `](</hack/reference/class/AsyncMysqlException/__construct/>)\
  Explicitly construct an `` AsyncMysqlException ``
+ [` ->failed(): bool `](</hack/reference/class/AsyncMysqlException/failed/>)\
  Returns whether the type of failure that produced the exception was a
  general connection or query failure
+ [` ->getResult(): AsyncMysqlErrorResult `](</hack/reference/class/AsyncMysqlException/getResult/>)\
  Returns the underlying `` AsyncMysqlErrorResult `` associated with the current
  exception
+ [` ->mysqlErrorCode(): int `](</hack/reference/class/AsyncMysqlException/mysqlErrorCode/>)\
  Returns the MySQL error number for that caused the current exception
+ [` ->mysqlErrorString(): string `](</hack/reference/class/AsyncMysqlException/mysqlErrorString/>)\
  Returns a human-readable string for the error encountered in the current
  exception
+ [` ->timedOut(): bool `](</hack/reference/class/AsyncMysqlException/timedOut/>)\
  Returns whether the type of failure that produced the exception was a
  timeout
<!-- HHAPIDOC -->
