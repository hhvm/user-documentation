``` yamlmeta
{
    "name": "mysql_async_fetch_array",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/mysql/ext_mysql-async.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ]
}
```




Returns an array that corresponds to the fetched row, if available




``` Hack
function mysql_async_fetch_array(
  resource $result,
  int $result_type = MYSQL_BOTH,
): mixed;
```




Nonblocking.




## Parameters




+ ` resource $result ` - resource that is being evaluated. This result comes
  from a call to mysql_async_query_result().
+ ` int $result_type = MYSQL_BOTH ` - The type of array that is to be fetched. It's a
  constant and can take the following values:
  MYSQL_ASSOC, MYSQL_NUM, and MYSQL_BOTH. The default
  is MYSQL_ASSOC




## Returns




* ` mixed ` - - Returns an array of strings that corresponds to the fetched
  row, or FALSE if there are no rows currently available. The
  type of returned array depends on how result_type is defined.
  By using MYSQL_BOTH, you'll get an array with both
  associative and number indices. Using MYSQL_ASSOC (the
  default), you only get associative indices (as
  mysql_fetch_assoc() works), using MYSQL_NUM, you only get
  number indices (as mysql_fetch_row() works).




If two or more columns of the result have the same field
names, the last column will take precedence. To access the
other column(s) of the same name, you must use the numeric
index of the column or make an alias for the column. For
aliased columns, you cannot access the contents with the
original column name.
<!-- HHAPIDOC -->
