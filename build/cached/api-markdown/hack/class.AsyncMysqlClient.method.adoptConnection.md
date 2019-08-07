``` yamlmeta
{
    "name": "adoptConnection",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlClient"
}
```




Create a new async connection from a synchronous MySQL instance




``` Hack
public static function adoptConnection(
  mixed $connection,
): AsyncMysqlConnection;
```




This is a synchronous function. You will block until the connection has
been adopted to an ` AsyncMysqlConnection `. Then you will be able to use
the async `` AsyncMysqlConnection `` methods like ``` queryf() ```, etc.




This is a tricky function to use and we are actually thinking of
deprecating it. This function *requires* a deprecated, MySQL resource.
Once this resource is adopted by a call to this function, it is no longer
valid in the context on which it was being used.




If you are using this function, you might consider just creating a
connection pool via ` AsyncMysqlConnectionPool ` since you presumably have
all the connection details anyway.




## Parameters




+ ` mixed $connection ` - The synchronous MySQL connection.




## Returns




* ` AsyncMysqlConnection ` - An `` AsyncMysqlConnection `` instance.




## Examples




This example shows how to take a synchronous MySQL connection and convert it to use an asynchronous MySQL connection via ` AsyncMysqlClient::adoptConnection() `.




**NOTE**: Right now this does not work with ` mysqli ` or `` PDO `` connections.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlClient/adoptConnection/001-basic-usage.php @@
<!-- HHAPIDOC -->
