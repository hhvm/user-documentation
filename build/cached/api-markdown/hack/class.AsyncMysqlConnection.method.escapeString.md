``` yamlmeta
{
    "name": "escapeString",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlConnection"
}
```




Escape a string to be safe to include in a raw query




``` Hack
public function escapeString(
  string $data,
): string;
```




Use this method to ensure your query is safe from, for example, SQL
injection if you are not using an API that automatically escapes
queries.




We strongly recommend using ` queryf() ` instead, which automatically
escapes string parameters.




This method is equivalent to PHP's
[mysql_real_escape_string()](<http://goo.gl/bnxqtE>).




## Parameters




+ ` string $data ` - The string to properly escape.




## Returns




* ` string ` - The escaped string.




## Examples




The following example shows you how to use ` AsyncMysqlConnection::escapeString `
in order to make sure any string pass to something like
`` AsyncMysqlConnection::query `` is safe for a database query. This is similar to
[` mysql_real_escape_string `](<http://php.net/manual/en/function.mysql-real-escape-string.php>).




We *strongly* recommend using an API like ` AsyncMysqlConnection::queryf ` instead,
which automatically escapes strings passed to `` %s `` placeholders.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlConnection/escapeString/001-basic-usage.php @@
<!-- HHAPIDOC -->
