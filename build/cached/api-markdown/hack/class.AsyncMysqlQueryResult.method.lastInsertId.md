``` yamlmeta
{
    "name": "lastInsertId",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlQueryResult"
}
```




The last ID inserted, if one existed, for the query that produced the
current result




``` Hack
public function lastInsertId(): int;
```




See the MySQL's [mysql_insert_id()](<http://goo.gl/qxIcPz>) documentation for
more information.




## Returns




+ ` int ` - The last insert id, or 0 if none existed.




## Examples




This example shows how to use the ` AsyncMysqlQueryResult::lastInsertId ` method to get the last primary id inserted into a table, if one exists. This will return `` 0 `` if your query did not actually insert an id, for example in a ``` SELECT ``` statement.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlQueryResult/lastInsertId/001-basic-usage.php @@
<!-- HHAPIDOC -->
