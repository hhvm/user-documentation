Every successful query has a result. And one of the methods on an `AsyncMysqlQueryResult` is `elapsedMicros()`, which tells you how long it took to perform the query and get the result.

Note that 

```
  elapsedMicros() ~== endTime() - startTime()
```
