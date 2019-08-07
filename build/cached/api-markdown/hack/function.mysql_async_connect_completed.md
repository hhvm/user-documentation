``` yamlmeta
{
    "name": "mysql_async_connect_completed",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/mysql/ext_mysql-async.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ]
}
```




A nonblocking test whether a connection has completed, or errored out




``` Hack
function mysql_async_connect_completed(
  resource $link_identifier = NULL,
): bool;
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




* ` bool ` - - Has the connection finished (either successfully or with
  error).
<!-- HHAPIDOC -->
