``` yamlmeta
{
    "name": "mysql_set_timeout",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/mysql/ext_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_mysql.hhi"
    ]
}
```




Sets query timeout for a connection







``` Hack
function mysql_set_timeout(
  int $query_timeout_ms = -1,
  resource $link_identifier = NULL,
): bool;
```




## Parameters




+ ` int $query_timeout_ms = -1 ` - How many milli-seconds to wait for an SQL
  query
+ ` resource $link_identifier = NULL ` - Which connection to set to. If absent,
  default or current connection will be
  applied to.




## Returns




* ` bool `
<!-- HHAPIDOC -->
