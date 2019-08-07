``` yamlmeta
{
    "name": "setReusable",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlConnection"
}
```




Sets if the current connection can be recycled without any clean up




``` Hack
public function setReusable(
  bool $reusable,
): void;
```




By default, the current connection *is* reusable.




If a connection in a ` AsyncMysqlConnectionPool ` is used, but you call
`` setReusable(false) ``, then you will have to create a whole new connection
instead of reusing this particular connection.




## Parameters




+ ` bool $reusable ` - Pass `` true `` to make the connection reusable; ``` false ```
  otherwise.




## Returns




* ` void `




## Examples




The following example shows how to make a connection not reusable in a connection pool with ` AsyncMysqlConnection::setReusable `. By default, connections in pools are reusable. So, here we create a pool connection that is assigned to `` $conn ``. When we close ``` $conn ```, that destroys that connection permanently. So when we get ```` $conn2 ````, a whole new connection will need to be created since we can't use the connection that was associated to ````` $conn `````.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlConnection/setReusable/001-basic-usage.php @@
<!-- HHAPIDOC -->
