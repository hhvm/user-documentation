Every connection has a connection result. You get the connection result from a call to `AsyncMysqlConnection::connectResult`. And one of the methods on an `AsyncMysqlConnectResult` is `endTime()`, which tells you when the connection operation completed.

Note that 

```
  elapsedMicros() ~== endTime() - startTime()
```
