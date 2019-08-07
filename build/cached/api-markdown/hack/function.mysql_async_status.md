``` yamlmeta
{
    "name": "mysql_async_status",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/mysql/ext_mysql-async.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ]
}
```




Returns the async operation status for a given mysql connection




``` Hack
function mysql_async_status(
  resource $link_identifier = NULL,
): int;
```




For
non-async connections, this returns ASYNC_OP_INVALID. For an async
connection, this can be either ASYNC_OP_UNSET (no pending async operation),
ASYNC_OP_QUERY (async query pending), or ASYNC_OP_CONNECT (async connection
pending). Returns -1 if the supplied connection itself is invalid.




## Parameters




+ ` resource $link_identifier = NULL ` - The MySQL connection




## Returns




* ` int ` - - Returns the async operation number for this mysql connection.
<!-- HHAPIDOC -->
