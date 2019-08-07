``` yamlmeta
{
    "name": "HH\\watchman_subscribe",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/watchman/ext_watchman.php",
        "api-sources/hhvm/hphp/hack/hhi/ext_watchman.hhi"
    ]
}
```




``` Hack
namespace HH;

function watchman_subscribe(
  string $json_query,
  string $path,
  string $sub_name,
  string $callback,
  ?string $socket_name = NULL,
): Awaitable<\void>;
```




## Parameters




+ ` string $json_query `
+ ` string $path `
+ ` string $sub_name `
+ ` string $callback `
+ ` ?string $socket_name = NULL `




## Returns




* ` Awaitable<\void> `
<!-- HHAPIDOC -->
