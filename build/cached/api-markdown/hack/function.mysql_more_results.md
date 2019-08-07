``` yamlmeta
{
    "name": "mysql_more_results",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/mysql/ext_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_mysql.hhi"
    ]
}
```




Used with mysql_multi_query() to check if there are more result sets to be
returned




``` Hack
function mysql_more_results(
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




* ` bool ` - - True if there is at least one more item in the result set.
<!-- HHAPIDOC -->
