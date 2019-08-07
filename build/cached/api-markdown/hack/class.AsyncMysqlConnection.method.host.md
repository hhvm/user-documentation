``` yamlmeta
{
    "name": "host",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlConnection"
}
```




The hostname associated with the current connection




``` Hack
public function host(): string;
```




## Returns




+ ` string ` - The hostname as a `` string ``.




## Examples




The following example shows how to get the host of the MySQL server that this connection is associated with via ` AsyncMysqlConnection::host `.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlConnection/host/001-basic-usage.php @@
<!-- HHAPIDOC -->
