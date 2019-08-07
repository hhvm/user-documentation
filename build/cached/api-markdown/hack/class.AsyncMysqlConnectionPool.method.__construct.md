``` yamlmeta
{
    "name": "__construct",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlConnectionPool"
}
```




Create a pool of connections to access a MySQL client




``` Hack
public function __construct(
  darray<string, mixed> $pool_options,
): void;
```




You can pass this constructor an ` array ` of options to tweak the behavior
of your pool. If you don't want an options, pass an empty `` array() ``.




Here are the keys for that array, and all values are ` int `, except for
`` expiration_policy ``, which is a ``` string ```:




+ ` per_key_connection_limit `: The maximum number of connections allowed
  in the pool for a single combination of
  hostname, port, db and username. The default
  is 50.
+ ` pool_connection_limit `: The maximum number of connections allowed in
  the pool. The default is 5000. It is
  interesting to note that this is the option
  that is set when you call
  `` AsyncMysqlClient::setPoolsConnectionLimit() ``.
+ ` idle_timeout_micros `: The maximum amount of time, in microseconds, that
  a connection is allowed to sit idle in the pool
  before being destroyed. The default is 4 seconds.
+ ` age_timeout_micros `: The maximum age, in microseconds, that a connection
  in the pool will be allowed to reach before being
  destroyed. The default is 60 seconds.
+ ` expiration_policy `: A `` string `` of either ``` 'IdleTime' ``` or ```` 'Age'" that specifies whether connections in the pool will be destroyed based on how long it sits idle or total age in the pool. The default is ````'Age'`.




## Parameters




* ` darray<string, mixed> $pool_options ` - The `` array `` of options for the connection pool.
  The key to each array element is an option listed
  above, while the value is an ``` int ``` or ```` string ````,
  depending on the option.




## Returns




- ` void `




## Examples




The following example shows you how to create an ` AsyncMysqlConnectionPool ` with various options, and then connect to MySQL asynchronously using those pool options. The various pool options that you can construct an AsyncMysqlConnectionPool with are:




+ ` connection_limit ` - Defines the limit of opened connections for each set of User, Database, Host, etc.
+ ` total_connection_limit ` - Defines the total limit of opened connection as a whole.
+ ` idle_timeout_micros ` - Sets the maximum idle time in microseconds a connection can be left in the pool without being killed by the pool.
+ ` age_timeout_micros ` - Sets the maximum age (means the time since started) of a connection, the pool will then kill this connection when reaches that limit.
+ ` expiration_policy ` - There are 2 policies for the expiration of a connection: `` IdleTime `` and ``` Age ```, in the Idle policy a connection will only die after some time being idle; in Age policy we extend the idle one to kill also by age.




This example focuses on the ` connection_limit ` and `` idle_timeout_micros `` options.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlConnectionPool/__construct/001-basic-usage.php @@
<!-- HHAPIDOC -->
