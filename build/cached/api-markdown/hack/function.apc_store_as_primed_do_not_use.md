``` yamlmeta
{
    "name": "apc_store_as_primed_do_not_use",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/apc/ext_apc.php"
    ]
}
```




Simlar to apc_store() but TTL is always 0 and there is TTL cap applied




``` Hack
function apc_store_as_primed_do_not_use(
  string $key,
  mixed $var,
): bool;
```




Do
not use in prod, use cachearchiver instead.




## Parameters




+ ` string $key ` - Store the variable using this name. keys are
  cache-unique, so storing a second value with the same key will overwrite
  the original value.
+ ` mixed $var ` - The variable to store




## Returns




* ` bool ` - - Returns TRUE on success or FALSE on failure.
<!-- HHAPIDOC -->
