``` yamlmeta
{
    "name": "AsyncMysqlRowBlock",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlRowBlock"
}
```




Represents a row block




A row block is either a full or partial set of result rows from a MySQL
query.




In a query result, the sum total of all the row blocks is the full result
of the query. Most of the time there is only one row block per query result
since the query was never interrupted or otherwise deterred by some outside
condition like exceeding network packet parameters.




You can get an instance of ` AsyncMysqlRowBlock ` via the
`` AsyncMysqlQueryResult::rowBlocks() `` call.




## Interface Synopsis




``` Hack
final class AsyncMysqlRowBlock implements IteratorAggregate, Countable, KeyedTraversable {...}
```




### Public Methods




+ [` ->at(int $row, mixed $field): mixed `](</hack/reference/class/AsyncMysqlRowBlock/at/>)\
  Get a field (column) value
+ [` ->count(): int `](</hack/reference/class/AsyncMysqlRowBlock/count/>)\
  Returns the number of rows in the current row block
+ [` ->fieldFlags(mixed $field): int `](</hack/reference/class/AsyncMysqlRowBlock/fieldFlags/>)\
  Returns the flags of the field (column)
+ [` ->fieldName(int $field): string `](</hack/reference/class/AsyncMysqlRowBlock/fieldName/>)\
  Returns the name of the field (column)
+ [` ->fieldType(mixed $field): int `](</hack/reference/class/AsyncMysqlRowBlock/fieldType/>)\
  Returns the type of the field (column)
+ [` ->fieldsCount(): int `](</hack/reference/class/AsyncMysqlRowBlock/fieldsCount/>)\
  Returns the number of fields (columns) associated with the current row
  block
+ [` ->getFieldAsDouble(int $row, mixed $field): float `](</hack/reference/class/AsyncMysqlRowBlock/getFieldAsDouble/>)\
  Get a certain field (column) value from a certain row as `` double ``
+ [` ->getFieldAsInt(int $row, mixed $field): int `](</hack/reference/class/AsyncMysqlRowBlock/getFieldAsInt/>)\
  Get a certain field (column) value from a certain row as `` int ``
+ [` ->getFieldAsString(int $row, mixed $field): string `](</hack/reference/class/AsyncMysqlRowBlock/getFieldAsString/>)\
  Get a certain field (column) value from a certain row as `` string ``
+ [` ->getIterator(): AsyncMysqlRowBlockIterator<int, AsyncMysqlRow> `](</hack/reference/class/AsyncMysqlRowBlock/getIterator/>)\
  Get the iterator for the rows in the block
+ [` ->getRow(int $row): AsyncMysqlRow `](</hack/reference/class/AsyncMysqlRowBlock/getRow/>)\
  Get a certain row in the current row block
+ [` ->isEmpty(): bool `](</hack/reference/class/AsyncMysqlRowBlock/isEmpty/>)\
  Returns whether there were any rows are returned in the current row block
+ [` ->isNull(int $row, mixed $field): bool `](</hack/reference/class/AsyncMysqlRowBlock/isNull/>)\
  Returns whether a field (column) value is `` null ``







### Private Methods




* [` ->__construct(): void `](</hack/reference/class/AsyncMysqlRowBlock/__construct/>)
<!-- HHAPIDOC -->
