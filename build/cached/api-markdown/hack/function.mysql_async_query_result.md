``` yamlmeta
{
    "name": "mysql_async_query_result",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/mysql/ext_mysql-async.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ]
}
```




Fetch a result object, if available, containing some rows of the nonblocking
query




``` Hack
function mysql_async_query_result(
  resource $link_identifier = NULL,
): ?resource;
```




## Parameters




+ ` resource $link_identifier = NULL ` - The MySQL connection. If the link
  identifier is not specified, the last link
  opened by mysql_connect() is assumed. If
  no such link is found, it will try to
  create one as if mysql_connect() was
  called with no arguments. If no connection
  is found or established, an E_WARNING
  level error is generated.




## Returns




* ` resource ` - - A mysql result object, or null if one isn't ready yet.
<!-- HHAPIDOC -->
