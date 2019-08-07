``` yamlmeta
{
    "name": "releaseConnection",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlConnection"
}
```




Releases the current connection and returns a synchronous MySQL connection




``` Hack
public function releaseConnection(): mixed;
```




This method will destroy the current ` AsyncMysqlConnection ` object and give
you back a vanilla, synchronous MySQL resource.




## Returns




+ ` mixed ` - A `` resource `` representing a
  [MySQL](<http://php.net/manual/en/book.mysql.php>) resource, or
  ` false ` on failure.




## Examples




If you ever want to get a plain, vanilla synchronous MySQL connection from your async connection, you call ` AsyncMysqlConnection::releaseConnection `. This examples show how to get such a connection, noting too that your async connection is destroyed.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlConnection/releaseConnection/001-basic-usage.php @@
<!-- HHAPIDOC -->
