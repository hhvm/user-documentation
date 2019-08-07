``` yamlmeta
{
    "name": "__construct",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql_exceptions.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlException"
}
```




Explicitly construct an ` AsyncMysqlException `




``` Hack
public function __construct(
  AsyncMysqlErrorResult $result,
);
```




Normally, you will ` catch ` an `` AsyncMysqlException ``, but if you want to
explictly construct one and, for example, ``` throw ``` it for some given reason,
then you pass it an ```` AsyncMysqlErrorResult ````.




## Parameters




+ ` AsyncMysqlErrorResult $result ` - An `` AsyncMysqlErrorResult `` that contains the error
  information for the failed operation.




## Examples




The following example shows how to catch an ` AsyncMysqlException `. Normally you would construct one implicitly via a `` try/catch `` block, like we did in this example.




The two current subclasses of ` AsyncMysqlException ` are `` AsyncMysqlConnectionException `` for connection problems and ``` AsyncMysqlQueryException ``` for querying issues.




Note that you can explicitly construct one by creating an object like ` new AsyncMysqlException(AsyncMysqlErrorResult $result) `. But this is not normally done.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlException/__construct/001-basic-usage.php @@
<!-- HHAPIDOC -->
