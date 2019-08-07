``` yamlmeta
{
    "name": "serverInfo",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlConnection"
}
```




The MySQL server version associated with the current connection




``` Hack
public function serverInfo(): string;
```




## Returns




+ ` string ` - The server version as a `` string ``.




## Examples




The following example shows how to get the version of the MySQL server that this connection is associated with via ` AsyncMysqlConnection::serverInfo `.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlConnection/serverInfo/001-basic-usage.php @@
<!-- HHAPIDOC -->
