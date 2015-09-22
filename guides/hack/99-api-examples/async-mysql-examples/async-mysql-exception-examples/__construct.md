The following example shows how to catch an `AsyncMysqlException`. Normally you would construct one implicitly via a `try/catch` block, like we did in this example. 

The two current subclasses of `AsyncMysqlException` are `AsyncMysqlConnectionException` for connection problems and `AsyncMysqlQueryException` for querying issues.

Note that you can explicitly construct one by creating an object like `new AsyncMysqlException(AsyncMysqlErrorResult $result)`. But this is not normally done.
