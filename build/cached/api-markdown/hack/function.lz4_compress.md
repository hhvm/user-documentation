``` yamlmeta
{
    "name": "lz4_compress",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/lz4/ext_lz4.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_lz4.hhi"
    ]
}
```




This function compresses the given string using the lz4lib data format, which
is primarily used for compressing and uncompressing memcache values




``` Hack
function lz4_compress(
  string $uncompressed,
  bool $high = false,
): mixed;
```




## Parameters




+ ` string $uncompressed ` - The uncompressed data
+ ` bool $high = false `




## Returns




* ` string ` - - The compressed data, or FALSE on error
<!-- HHAPIDOC -->
