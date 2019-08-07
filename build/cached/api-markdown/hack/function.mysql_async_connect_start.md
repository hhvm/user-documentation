``` yamlmeta
{
    "name": "mysql_async_connect_start",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/mysql/ext_mysql-async.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ]
}
```




Initiate an asynchronous (non-blocking) connection to the specified MySQL
server




``` Hack
function mysql_async_connect_start(
  string $server = '',
  string $username = '',
  string $password = '',
  string $database = '',
): mixed;
```




## Parameters




+ ` string $server = '' ` - The MySQL server. It can also include a port
  number. e.g. "hostname:port" or a path to a local
  socket e.g. ":/path/to/socket" for the localhost.




If the PHP directive mysql.default_host is
undefined (default), then the default value is
'localhost:3306'. In SQL safe mode, this parameter
is ignored and value 'localhost:3306' is always
used.

* ` string $username = '' ` - The username. Default value is defined by
  mysql.default_user. In SQL safe mode, this
  parameter is ignored and the name of the user that
  owns the server process is used.
* ` string $password = '' ` - The password. Default value is defined by
  mysql.default_password. In SQL safe mode, this
  parameter is ignored and empty password is used.
* ` string $database = '' ` - The name of the database that will be selected.




## Returns




- ` mixed ` - - Initiate an asynchronous mysql connection.
<!-- HHAPIDOC -->
