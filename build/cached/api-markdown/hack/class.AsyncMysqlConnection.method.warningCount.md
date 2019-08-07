``` yamlmeta
{
    "name": "warningCount",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlConnection"
}
```




The number of errors, warnings, and notes returned during execution of
the previous SQL statement




``` Hack
public function warningCount(): int;
```




## Returns




+ ` int ` - The `` int `` count of errors, warnings, etc.




## Examples




The following example shows how to get the number of errors or warnings on the last SQL query via ` AsyncMysqlConnection::warningCount `.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlConnection/warningCount/001-basic-usage.php @@
<!-- HHAPIDOC -->
