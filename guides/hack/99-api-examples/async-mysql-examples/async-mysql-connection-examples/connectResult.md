This example shows how to get data about the async MySQL connection you made via a call to `AsyncMysqlConnection::connectResult`. An `AsyncMysqlConnectResult` is returned and there are various statistical methods you can call. Here, we call `elapsedTime` to show the time it took to make the connection.

Interestingly, if you run this example twice or more, you may notice that the second time on will show a lower elapsed time than the first. This could be due to caching mechanisms, etc.
