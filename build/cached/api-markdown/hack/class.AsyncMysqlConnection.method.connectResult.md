``` yamlmeta
{
    "name": "connectResult",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlConnection"
}
```




Returns the ` AsyncMysqlConnectResult ` for the current connection




``` Hack
public function connectResult(): ?AsyncMysqlConnectResult;
```




An ` AsyncMysqlConnectResult ` provides information about the timing for
creating the current connection.




## Returns




+ ` ?AsyncMysqlConnectResult ` - An `` AsyncMysqlConnectResult `` object or ``` null ``` if the
  ```` AsyncMysqlConnection ```` was not created in the MySQL client.




## Examples




This example shows how to get data about the async MySQL connection you made via a call to ` AsyncMysqlConnection::connectResult `. An `` AsyncMysqlConnectResult `` is returned and there are various statistical methods you can call. Here, we call ``` elapsedTime ``` to show the time it took to make the connection.




Interestingly, if you run this example twice or more, you may notice that the second time on will show a lower elapsed time than the first. This could be due to caching mechanisms, etc.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlConnection/connectResult/001-basic-usage.php @@
<!-- HHAPIDOC -->
