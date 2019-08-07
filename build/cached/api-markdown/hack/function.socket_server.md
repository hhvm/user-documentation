``` yamlmeta
{
    "name": "socket_server",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/sockets/ext_sockets.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_socket.hhi"
    ]
}
```




``` Hack
function socket_server(
  string $hostname,
  int $port = -1,
  mixed &$errnum = NULL,
  mixed &$errstr = NULL,
): mixed;
```




## Parameters




+ ` string $hostname `
+ ` int $port = -1 `
+ ` mixed &$errnum = NULL `
+ ` mixed &$errstr = NULL `




## Returns




* ` mixed `
<!-- HHAPIDOC -->
