``` yamlmeta
{
    "name": "lastActivityTime",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlConnection"
}
```




Last time a successful activity was made in the current connection, in
seconds since epoch




``` Hack
public function lastActivityTime(): float;
```




The first successful activity of the current connection is its creation.




## Returns




+ ` float ` - A `` float `` representing the number of seconds ago since epoch
  that we had successful activity on the current connection.




## Examples




This example shows how to determine the last time a successful call was made using a given connection via ` AsyncMysqlConnection::lastActivityTime `. The value returned is seconds since epoch as a `` float ``.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlConnection/lastActivityTime/001-basic-usage.php @@
<!-- HHAPIDOC -->
