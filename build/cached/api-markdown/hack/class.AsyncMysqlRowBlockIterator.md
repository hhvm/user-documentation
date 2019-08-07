``` yamlmeta
{
    "name": "AsyncMysqlRowBlockIterator",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php"
    ],
    "class": "AsyncMysqlRowBlockIterator"
}
```




A class to represent an iterator over the rows of a ` AsyncMysqlRowBlock `




You can iterate over all the rows of an ` AsyncMysqlRowBlock ` one by one until
the iterator is not valid any longer.




## Interface Synopsis




``` Hack
final class AsyncMysqlRowBlockIterator implements HH\KeyedIterator {...}
```




### Public Methods




+ [` ->current(): AsyncMysqlRow `](</hack/reference/class/AsyncMysqlRowBlockIterator/current/>)\
  Get the current row

+ [` ->key(): int `](</hack/reference/class/AsyncMysqlRowBlockIterator/key/>)\
  Get the current row number

+ [` ->next(): void `](</hack/reference/class/AsyncMysqlRowBlockIterator/next/>)\
  Advance the iterator to the next row

+ [` ->rewind(): void `](</hack/reference/class/AsyncMysqlRowBlockIterator/rewind/>)\
  Reset the iterator to the first row

+ [` ->valid(): bool `](</hack/reference/class/AsyncMysqlRowBlockIterator/valid/>)\
  Check if iterator is at a valid `` AsyncMysqlRow ``








### Private Methods




* [` ->__construct(): void `](</hack/reference/class/AsyncMysqlRowBlockIterator/__construct/>)
<!-- HHAPIDOC -->
