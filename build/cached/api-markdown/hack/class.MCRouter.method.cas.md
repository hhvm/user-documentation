``` yamlmeta
{
    "name": "cas",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/mcrouter/ext_mcrouter.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_mcrouter.hhi"
    ],
    "class": "MCRouter"
}
```




Compare and set







``` Hack
public function cas(
  int $cas,
  string $key,
  string $value,
  int $expiration = 0,
): Awaitable<void>;
```




## Parameters




+ ` int $cas ` - CAS token as returned by getRecord()
+ ` string $key ` - Name of the key to store
+ ` string $value ` - Datum to store
+ ` int $expiration = 0 `




## Returns




* ` Awaitable<void> `
<!-- HHAPIDOC -->
