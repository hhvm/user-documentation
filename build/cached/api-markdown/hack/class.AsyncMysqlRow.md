``` yamlmeta
{
    "name": "AsyncMysqlRow",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlRow"
}
```




A class to represent a row




You can think of a row just like you do a database row that might be
returned as a result from a query. The row has values associated with
each column.




## Interface Synopsis




``` Hack
final class AsyncMysqlRow implements MysqlRow {...}
```




### Public Methods




+ [` ->at(mixed $field): mixed `](</hack/reference/class/AsyncMysqlRow/at/>)\
  Get field (column) value indexed by the `` field ``
+ [` ->count(): int `](</hack/reference/class/AsyncMysqlRow/count/>)\
  Get the number of fields (columns) in the current row
+ [` ->fieldType(mixed $field): int `](</hack/reference/class/AsyncMysqlRow/fieldType/>)\
  Returns the type of the field (column)
+ [` ->getFieldAsDouble(mixed $field): float `](</hack/reference/class/AsyncMysqlRow/getFieldAsDouble/>)\
  Get a certain field (column) value as a `` double ``
+ [` ->getFieldAsInt(mixed $field): int `](</hack/reference/class/AsyncMysqlRow/getFieldAsInt/>)\
  Get a certain field (column) value as an `` int ``
+ [` ->getFieldAsString(mixed $field): string `](</hack/reference/class/AsyncMysqlRow/getFieldAsString/>)\
  Get a certain field (column) value as a `` string ``
+ [` ->getIterator(): AsyncMysqlRowIterator<string, mixed> `](</hack/reference/class/AsyncMysqlRow/getIterator/>)\
  Get the iterator over the fields in the current row
+ [` ->isNull(mixed $field): bool `](</hack/reference/class/AsyncMysqlRow/isNull/>)\
  Returns whether a field (column) value is `` null ``







### Private Methods




* [` ->__construct(): void `](</hack/reference/class/AsyncMysqlRow/__construct/>)
<!-- HHAPIDOC -->
