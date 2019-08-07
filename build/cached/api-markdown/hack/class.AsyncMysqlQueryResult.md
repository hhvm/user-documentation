``` yamlmeta
{
    "name": "AsyncMysqlQueryResult",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlQueryResult"
}
```




The result of a successfully executed MySQL query




Not only does this class provide timing information about retrieving the
successful result, it provides the actual result information (e.g., result
rows).




You get an ` AsyncMysqlQueryResult ` through calls to
`` AsyncMysqlConnection::query() ``, ``` AsyncMysqlConection::queryf() ``` and
```` AsyncMysqlConnection::multiQuery() ````




## Interface Synopsis




``` Hack
final class AsyncMysqlQueryResult extends AsyncMysqlResult {...}
```




### Public Methods




+ [` ->clientStats(): AsyncMysqlClientStats `](</hack/reference/class/AsyncMysqlQueryResult/clientStats/>)\
  Returns the MySQL client statistics at the moment the successful query
  ended

+ [` ->elapsedMicros(): int `](</hack/reference/class/AsyncMysqlQueryResult/elapsedMicros/>)\
  The total time for the successful query to occur, in microseconds

+ [` ->endTime(): float `](</hack/reference/class/AsyncMysqlQueryResult/endTime/>)\
  The end time when the successful query began, in seconds since epoch

+ [` ->lastInsertId(): int `](</hack/reference/class/AsyncMysqlQueryResult/lastInsertId/>)\
  The last ID inserted, if one existed, for the query that produced the
  current result

+ [` ->mapRows(): Vector<Map<string, ?string>> `](</hack/reference/class/AsyncMysqlQueryResult/mapRows/>)\
  Returns the actual rows returned by the successful query, each row
  including the name and value for each column

+ [` ->mapRowsTyped(): Vector<Map<string, mixed>> `](</hack/reference/class/AsyncMysqlQueryResult/mapRowsTyped/>)\
  Returns the actual rows returned by the successful query, each row
  including the name and typed-value for each column

+ [` ->noIndexUsed(): bool `](</hack/reference/class/AsyncMysqlQueryResult/noIndexUsed/>)\
  Returns whether or not any of the queries executed did not use an index
  during execution

+ [` ->numRows(): int `](</hack/reference/class/AsyncMysqlQueryResult/numRows/>)\
  The number of rows in the current result

+ [` ->numRowsAffected(): int `](</hack/reference/class/AsyncMysqlQueryResult/numRowsAffected/>)\
  The number of database rows affected in the current result

+ [` ->recvGtid(): string `](</hack/reference/class/AsyncMysqlQueryResult/recvGtid/>)\
  The GTID of database returned for the current commit

+ [` ->rowBlocks(): Vector<AsyncMysqlRowBlock> `](</hack/reference/class/AsyncMysqlQueryResult/rowBlocks/>)\
  Returns a `` Vector `` representing all row blocks returned by the successful
  query

+ [` ->startTime(): float `](</hack/reference/class/AsyncMysqlQueryResult/startTime/>)\
  The start time when the successful query began, in seconds since epoch

+ [` ->vectorRows(): Vector<KeyedContainer<int, ?string>> `](</hack/reference/class/AsyncMysqlQueryResult/vectorRows/>)\
  Returns the actual rows returned by the successful query, each row
  including the values for each column

+ [` ->vectorRowsTyped(): Vector<KeyedContainer<int, mixed>> `](</hack/reference/class/AsyncMysqlQueryResult/vectorRowsTyped/>)\
  Returns the actual rows returned by the successful query, each row
  including the typed values for each column








### Private Methods




* [` ->__construct(): void `](</hack/reference/class/AsyncMysqlQueryResult/__construct/>)
<!-- HHAPIDOC -->
