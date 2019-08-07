``` yamlmeta
{
    "name": "elapsedMicros",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlConnectResult"
}
```




The total time for the establishment of the MySQL connection,
in microseconds




``` Hack
public function elapsedMicros(): int;
```




## Returns




+ ` int ` - the total establishing connection time as `` int `` microseconds.




## Examples




Every connection has a connection result. You get the connection result from a call to ` AsyncMysqlConnection::connectResult `. And one of the methods on an `` AsyncMysqlConnectResult `` is ``` elapsedMicros() ```, which tells you how long it took to make the connection.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlConnectResult/elapsedMicros/001-basic-usage.php @@
<!-- HHAPIDOC -->
