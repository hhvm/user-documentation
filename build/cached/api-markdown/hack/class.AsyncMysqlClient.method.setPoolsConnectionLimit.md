``` yamlmeta
{
    "name": "setPoolsConnectionLimit",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlClient"
}
```




Sets the connection limit of all connection pools using this client




``` Hack
public static function setPoolsConnectionLimit(
  int $limit,
): void;
```




Use this function to toggle the number of allowed async connections on the
pools connecting to MySQL with this current client. For example, if you
set the limit to 2, and you try a third connection on the same pool, an
` AsyncMysqlConnectException ` exception will be thrown.




## Parameters




+ ` int $limit ` - The limit for all pools.




## Returns




* ` void `




## Examples




You can use ` AsyncMysqlClient::setPoolsConnectionLimit() ` to toggle the number of allowed async connections on the client. In this example, we are setting the number of allowed pool connections to be 2, but trying to do 3 connections, and that ends up giving an exception.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlClient/setPoolsConnectionLimit/001-basic-usage.php @@
<!-- HHAPIDOC -->
