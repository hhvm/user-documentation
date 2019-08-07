``` yamlmeta
{
    "name": "furchash_hphp_ext",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/hash/ext_hash.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_hash.hhi"
    ]
}
```




furchash_hphp_ext







``` Hack
function furchash_hphp_ext(
  string $key,
  int $len,
  int $nPart,
): int;
```




## Parameters




+ ` string $key ` - The key to hash
+ ` int $len ` - Number of bytes to use from the hash
+ ` int $nPart `




## Returns




* ` int ` - - A number in the range of 0-(nPart-1)
<!-- HHAPIDOC -->
