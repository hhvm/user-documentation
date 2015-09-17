`AsyncMysqlConnection::multiQuery` is similar to `AsyncMysqlConnection::query`, except that you can pass an array of queries to run one after the other. Then when you `await` on the call, you will get a `Vector` of `AsyncMysqlQueryResult`, one result for each query.

