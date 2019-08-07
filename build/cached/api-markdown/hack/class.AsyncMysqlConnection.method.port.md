``` yamlmeta
{
    "name": "port",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlConnection"
}
```




The port on which the MySQL instance is running




``` Hack
public function port(): int;
```




## Returns




+ ` int ` - The port as an `` int ``.




## Examples




The following example shows how to get the port of the MySQL server that this connection is associated with via ` AsyncMysqlConnection::port `.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlConnection/port/001-basic-usage.php @@
<!-- HHAPIDOC -->
