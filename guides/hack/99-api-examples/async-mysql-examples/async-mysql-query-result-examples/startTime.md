Every successful query has a result. And one of the methods on an `AsyncMysqlQueryResult` is `startTime()`, which tells you the time when we started to get our result.

Note that 

```
  elapsedMicros() ~== endTime() - startTime()
```
