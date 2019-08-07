``` yamlmeta
{
    "name": "apc_size",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/apc/ext_apc.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_apc.hhi"
    ]
}
```




Find the in-memory size of a key in APC, for debugging purposes




``` Hack
function apc_size(
  string $key,
): ?int;
```




## Parameters




+ ` string $key ` - The key to find the size of.




## Returns




* ` mixed ` - - Returns the current size of a key or null on failure.
<!-- HHAPIDOC -->
