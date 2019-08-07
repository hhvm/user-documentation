``` yamlmeta
{
    "name": "lz4hccompress",
    "sources": [
        "api-sources/hhvm/hphp/system/php/zlib/ext_zlib.php"
    ]
}
```




This is a wrapper function as lz4hccompress is now lz4_hccompress




``` Hack
function lz4hccompress(
  string $uncompressed,
);
```




https://github.com/facebook/hhvm/pull/3169 - 11/07/2014




## Parameters




+ ` string $uncompressed `
<!-- HHAPIDOC -->
