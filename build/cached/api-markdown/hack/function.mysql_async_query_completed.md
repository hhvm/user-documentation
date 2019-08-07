``` yamlmeta
{
    "name": "mysql_async_query_completed",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/mysql/ext_mysql-async.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ]
}
```




Perform a nonblocking test whether an asynchronous query has completed




``` Hack
function mysql_async_query_completed(
  resource $result,
): bool;
```




## Parameters




+ ` resource $result ` - The mysql result object from
  mysql_async_query_result.




## Returns




* ` bool ` - - True if the the query has completed (i.e., either all rows
  have been returned or an error occurred).
<!-- HHAPIDOC -->
