``` yamlmeta
{
    "name": "AsyncMysqlRowIterator",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php"
    ],
    "class": "AsyncMysqlRowIterator"
}
```




A class to represent an iterator over the fields (columns) in a row




You can iterate over all the fields (columns) of an ` AsyncMysqlBlock ` one by
one until the iterator is not valid any longer.




## Interface Synopsis




``` Hack
final class AsyncMysqlRowIterator implements HH\KeyedIterator {...}
```




### Public Methods




+ [` ->current(): string `](</hack/reference/class/AsyncMysqlRowIterator/current/>)\
  Get the current field (column) name
+ [` ->key(): int `](</hack/reference/class/AsyncMysqlRowIterator/key/>)\
  Get the current field (column) number
+ [` ->next(): void `](</hack/reference/class/AsyncMysqlRowIterator/next/>)\
  Advance the iterator to the next field (column)
+ [` ->rewind(): void `](</hack/reference/class/AsyncMysqlRowIterator/rewind/>)\
  Reset the iterator to the first field (column)
+ [` ->valid(): bool `](</hack/reference/class/AsyncMysqlRowIterator/valid/>)\
  Check if the iterator is at a valid field (column)







### Private Methods




* [` ->__construct(): void `](</hack/reference/class/AsyncMysqlRowIterator/__construct/>)
<!-- HHAPIDOC -->
