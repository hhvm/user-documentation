``` yamlmeta
{
    "name": "snappy_uncompress",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/snappy/ext_snappy.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_snappy.hhi"
    ]
}
```




This function uncompress a compressed string




``` Hack
function snappy_uncompress(
  string $data,
): mixed;
```




## Parameters




+ ` string $data ` - The data compressed by snappy_compress()




## Returns




* ` string ` - - The decompressed string or FALSE if an error occurred.
<!-- HHAPIDOC -->
