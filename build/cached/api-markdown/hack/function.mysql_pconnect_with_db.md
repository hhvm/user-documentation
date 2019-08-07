``` yamlmeta
{
    "name": "mysql_pconnect_with_db",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/mysql/ext_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_mysql.hhi"
    ]
}
```




``` Hack
function mysql_pconnect_with_db(
  string $server = '',
  string $username = '',
  string $password = '',
  string $database = '',
  int $client_flags = 0,
  int $connect_timeout_ms = -1,
  int $query_timeout_ms = -1,
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
+ ` darray<string> $conn_attrs = array ( ) `




## Returns




* ` mixed `
<!-- HHAPIDOC -->
