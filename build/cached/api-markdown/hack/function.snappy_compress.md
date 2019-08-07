``` yamlmeta
{
    "name": "snappy_compress",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/snappy/ext_snappy.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_snappy.hhi"
    ]
}
```




This function compress the given string using the Snappy data format




``` Hack
function snappy_compress(
  string $data,
): mixed;
```




For details on the Snappy compression algorithm go to
http://code.google.com/p/snappy/.




## Parameters




+ ` string $data ` - The data to compress




## Returns




* ` string ` - - The compressed string or FALSE if an error occurred.
<!-- HHAPIDOC -->
