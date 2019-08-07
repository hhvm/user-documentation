``` yamlmeta
{
    "name": "hphp_murmurhash",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/hash/ext_hash.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_hash.hhi"
    ]
}
```




hphp_murmurhash







``` Hack
function hphp_murmurhash(
  string $key,
  int $len,
  int $seed,
): int;
```




## Parameters




+ ` string $key ` - The key to hash
+ ` int $len ` - Number of bytes to use from the key
+ ` int $seed ` - The seed to use for hashing




## Returns




* ` int ` - The Int64 hash of the first len input characters
<!-- HHAPIDOC -->
