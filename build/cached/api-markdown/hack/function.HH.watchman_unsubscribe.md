``` yamlmeta
{
    "name": "HH\\watchman_unsubscribe",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/watchman/ext_watchman.php",
        "api-sources/hhvm/hphp/hack/hhi/ext_watchman.hhi"
    ]
}
```




``` Hack
namespace HH;

function watchman_unsubscribe(
  string $sub_name,
): Awaitable<string>;
```




## Parameters




+ ` string $sub_name `




## Returns




* ` Awaitable<string> `
<!-- HHAPIDOC -->
