``` yamlmeta
{
    "name": "getPoolStats",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlConnectionPool"
}
```




Returns statistical information for the current pool




``` Hack
public function getPoolStats(): darray<string, mixed>;
```




Information provided includes the number of pool connections that were
created and destroyed, how many connections were requested, and how many
times the pool was hit or missed when creating the connection. The
returned ` array ` keys are:




+ ` created_pool_connections `
+ ` destroyed_pool_connections `
+ ` connections_requested `
+ ` pool_hits `
+ ` pool_misses `




## Returns




* ` darray<string, mixed> ` - A string-keyed `` array `` with the statistical information above.




## Examples




The following example shows how to gather ` AsyncMySqlConnectionPool ` statistics using its `` getStats() `` method. The statistics that are gathered are connection statistics.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlConnectionPool/getPoolStats/001-basic-usage.php @@
<!-- HHAPIDOC -->
