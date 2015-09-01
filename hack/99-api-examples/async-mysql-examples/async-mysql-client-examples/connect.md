The following example shows how to use `AsyncMysqlClient::connect()` to connect to a database asynchronously and get a result from that connection. Notice a couple of things:

* The parameters to `connect()` are very similar to that of a normal [`mysqli` connection](http://php.net/manual/en/mysqli.construct.php).
* With `AsyncMysqlClient`, we are able to take full advantage of [async](../../../03-async) to perform other DB connection or I/O operations while waiting for this connection to return.
