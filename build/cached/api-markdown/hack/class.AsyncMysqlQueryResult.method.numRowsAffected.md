``` yamlmeta
{
    "name": "numRowsAffected",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlQueryResult"
}
```




The number of database rows affected in the current result




``` Hack
public function numRowsAffected(): int;
```




This is particularly useful for ` INSERT `, `` DELETE ``, ``` UPDATE ``` statements.




This is complementary to ` numRows() ` as they might be the same value, but
if this was an `` INSERT `` query, for example, then this might be a non-zero
value, while ``` numRows() ``` would be 0.




See the MySQL's [mysql_affected_rows()](<http://goo.gl/1Sj2zS>)
documentation for more information.




## Returns




+ ` int ` - The number of rows affected as an `` int ``.




## Examples




This example shows how to determine the number of rows affected by a given query using ` AsyncMysqlQueryResult::numRowsAffected `. This is especially useful on an `` INSERT `` query or similar, where you won't get any rows back in your result, but you want to make sure your query did what it was supposed to do.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlQueryResult/numRowsAffected/001-basic-usage.php @@
<!-- HHAPIDOC -->
