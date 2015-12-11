This example shows how to take a synchronous MySQL connection and convert it to use an asynchronous MySQL connection via `AsyncMysqlClient::adoptConnection()`.

**NOTE**: Right now this does not work with `mysqli` or `PDO` connections.
