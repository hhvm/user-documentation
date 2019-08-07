``` yamlmeta
{
    "name": "mysql_connect_with_ssl",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/mysql/ext_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_mysql.hhi"
    ]
}
```




``` Hack
function mysql_connect_with_ssl(
  string $server = '',
  string $username = '',
  string $password = '',
  string $database = '',
  int $client_flags = 0,
  int $connect_timeout_ms = -1,
  int $query_timeout_ms = -1,
  ?MySSLContextProvider $ssl_context = NULL,
  darray<string> $conn_attrs = array (
),
): mixed;
```




## Parameters




+ ` string $server = '' `
+ ` string $username = '' `
+ ` string $password = '' `
+ ` string $database = '' `
+ ` int $client_flags = 0 `
+ ` int $connect_timeout_ms = -1 `
+ ` int $query_timeout_ms = -1 `
+ ` ?MySSLContextProvider $ssl_context = NULL `
+ ` darray<string> $conn_attrs = array ( ) `




## Returns




* ` mixed `
<!-- HHAPIDOC -->
