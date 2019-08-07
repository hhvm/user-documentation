``` yamlmeta
{
    "name": "mysql_async_query_start",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/mysql/ext_mysql-async.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ]
}
```




Initiate a nonblocking query on a given connection




``` Hack
function mysql_async_query_start(
  string $query,
  resource $link_identifier = NULL,
): bool;
```




## Parameters




+ ` string $query ` - An SQL query




The query string should not end with a
semicolon. Data inside the query should be
properly escaped.

* ` resource $link_identifier = NULL ` - The MySQL connection. If the link
  identifier is not specified, the last link
  opened by mysql_connect() is assumed. If
  no such link is found, it will try to
  create one as if mysql_connect() was
  called with no arguments. If no connection
  is found or established, an E_WARNING
  level error is generated.




## Returns




- ` bool ` - - TRUE if the query can properly be prepared and queued on the
  network.
<!-- HHAPIDOC -->
