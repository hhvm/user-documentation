``` yamlmeta
{
    "name": "HH\\watchman_run",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/watchman/ext_watchman.php",
        "api-sources/hhvm/hphp/hack/hhi/ext_watchman.hhi"
    ]
}
```




``` Hack
namespace HH;

function watchman_run(
  string $json_query,
  ?string $socket_name = NULL,
): Awaitable<string>;
```




## Parameters




+ ` string $json_query `
+ ` ?string $socket_name = NULL `




## Returns




* ` Awaitable<string> `
<!-- HHAPIDOC -->
