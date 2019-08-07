``` yamlmeta
{
    "name": "HH\\watchman_sync_sub",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/watchman/ext_watchman.php",
        "api-sources/hhvm/hphp/hack/hhi/ext_watchman.hhi"
    ]
}
```




``` Hack
namespace HH;

function watchman_sync_sub(
  string $sub_name,
  int $timeout_ms = 0,
): Awaitable<bool>;
```




## Parameters




+ ` string $sub_name `
+ ` int $timeout_ms = 0 `




## Returns




* ` Awaitable<bool> `
<!-- HHAPIDOC -->
