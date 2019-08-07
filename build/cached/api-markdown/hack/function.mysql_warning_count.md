``` yamlmeta
{
    "name": "mysql_warning_count",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/mysql/ext_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_mysql.hhi"
    ]
}
```




Returns the number of errors generated during execution of the previous SQL
statement




``` Hack
function mysql_warning_count(
  resource $link_identifier = NULL,
): mixed;
```




To retrieve warning messages you can use the SQL command SHOW
WARNINGS [limit row_count].




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




* ` int ` - - Returns the number of warnings from the last MySQL function, or
  0 (zero) if no warnings occurred.
<!-- HHAPIDOC -->
