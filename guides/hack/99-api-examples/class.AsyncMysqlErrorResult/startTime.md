When an error occurs when establishing a connection or on a query, and you catch the exception that is thrown, you will get an `AsyncMysqlErrorResult`. And one of the methods on an `AsyncMysqlErrorResult` is `startTime()`, which tells you when the connection operation began.

Note that 

```
  elapsedMicros() ~== endTime() - startTime()
```

