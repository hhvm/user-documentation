``` yamlmeta
{
    "name": "isReusable",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlConnection"
}
```




Returns whether or not the current connection is reusable




``` Hack
public function isReusable(): bool;
```




By default, the current connection is reusable by the pool. But if you call
` setResuable(false) `, then the current connection will not be reusable by
the connection pool.




## Returns




+ ` bool ` - `` true `` if the connection is reusable; ``` false ``` otherwise.




## Examples




The following example shows how to make a connection not reusable in a connection pool with ` AsyncMysqlConnection::setReusable ` and test it with `` AsyncMysqlConnection::isReusable ``. By default, connections in pools are reusable. So, here we create a pool connection that is assigned to ``` $conn ```. When we close ```` $conn ````, that destroys that connection permanently. So when we get ````` $conn2 `````, a whole new connection will need to be created since we can't use the connection that was associated to `````` $conn ``````.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlConnection/isReusable/001-basic-usage.php @@
<!-- HHAPIDOC -->
