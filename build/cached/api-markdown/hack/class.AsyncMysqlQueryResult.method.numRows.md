``` yamlmeta
{
    "name": "numRows",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlQueryResult"
}
```




The number of rows in the current result




``` Hack
public function numRows(): int;
```




This is particularly useful for ` SELECT ` statements.




This is complementary to ` numRowsAffected() ` as they might be the same
value, but if this was an `` INSERT `` query, for example, then this might be
0, while ``` numRowsAffected() ``` could be non-zero.




See the MySQL's [mysql_num_rows()](<http://goo.gl/Rv5NaL>) documentation for
more information.




## Returns




+ ` int ` - The number of rows in the current result as an `` int ``.




## Examples




This example shows how to determine the number of rows returned from a given query using ` AsyncMysqlQueryResult::numRows `.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlQueryResult/numRows/001-basic-usage.php @@
<!-- HHAPIDOC -->
