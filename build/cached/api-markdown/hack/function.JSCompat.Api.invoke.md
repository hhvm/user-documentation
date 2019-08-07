``` yamlmeta
{
    "name": "JSCompat\\Api\\invoke",
    "sources": [
        "api-sources/hhvm/hphp/hack/hhi/ext_hhjs.hhi"
    ]
}
```




``` Hack
namespace JSCompat\Api;

function invoke(
  \callable $thunk,
  \mixed ...$args,
): Awaitable<\mixed>;
```




## Parameters




+ ` \callable $thunk `
+ ` \mixed ...$args `




## Returns




* ` Awaitable<\mixed> `
<!-- HHAPIDOC -->
