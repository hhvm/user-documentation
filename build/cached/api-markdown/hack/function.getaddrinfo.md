``` yamlmeta
{
    "name": "getaddrinfo",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/sockets/ext_sockets.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_socket.hhi"
    ]
}
```




``` Hack
function getaddrinfo(
  string $host,
  string $port,
  int $family = 0,
  int $socktype = 0,
  int $protocol = 0,
  int $flags = 0,
): mixed;
```




## Parameters




+ ` string $host `
+ ` string $port `
+ ` int $family = 0 `
+ ` int $socktype = 0 `
+ ` int $protocol = 0 `
+ ` int $flags = 0 `




## Returns




* ` mixed `
<!-- HHAPIDOC -->
