``` yamlmeta
{
    "name": "lz4_uncompress",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/lz4/ext_lz4.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_lz4.hhi"
    ]
}
```




This function uncompresses the given string given that it is in the lz4lib
data format, which is primarily used for compressing and uncompressing
memcache values







``` Hack
function lz4_uncompress(
  string $compressed,
): mixed;
```




## Parameters




+ ` string $compressed ` - The data compressed by lz4compress().




## Returns




* ` string ` - - The uncompressed data or FALSE on error
<!-- HHAPIDOC -->
