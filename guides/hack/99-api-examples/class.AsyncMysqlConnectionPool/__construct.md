The following example shows you how to create an `AsyncMysqlConnectionPool` with various options, and then connect to MySQL asynchronously using those pool options. The various pool options that you can construct an AsyncMysqlConnectionPool with are:

* `connection_limit` - Defines the limit of opened connections for each set of User, Database, Host, etc.
* `total_connection_limit` - Defines the total limit of opened connection as a whole.
* `idle_timeout_micros` - Sets the maximum idle time in microseconds a connection can be left in the pool without being killed by the pool.
* `age_timeout_micros` - Sets the maximum age (means the time since started) of a connection, the pool will then kill this connection when reaches that limit.
* `expiration_policy` - There are 2 policies for the expiration of a connection: `IdleTime` and `Age`, in the Idle policy a connection will only die after some time being idle; in Age policy we extend the idle one to kill also by age.

This example focuses on the `connection_limit` and `idle_timeout_micros` options.
