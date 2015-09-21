Every successful query has a result. And one of the methods on an `AsyncMysqlQueryResult` is `endTime()`, which tells you how the time when we finally got our result.

Note that 

```
  elapsedMicros() ~== endTime() - startTime()
```
