``` yamlmeta
{
    "name": "close",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlConnection"
}
```




Close the current connection




``` Hack
public function close(): void;
```




## Returns




+ ` void `




## Examples




Closing a database connection is usually a good idea. This example shows the closing of a connection using ` AsyncMysqlConnection::close ` and then tries to invoke a query on that connection afterwards.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlConnection/close/001-basic-usage.php @@
<!-- HHAPIDOC -->
