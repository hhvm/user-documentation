``` yamlmeta
{
    "name": "thrift_protocol_read_compact_struct",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/thrift/ext_thrift.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_thrift.hhi"
    ]
}
```




``` Hack
function thrift_protocol_read_compact_struct(
  object $transportobj,
  string $obj_typename,
): object;
```




## Parameters




+ ` object $transportobj `
+ ` string $obj_typename `




## Returns




* ` object `
<!-- HHAPIDOC -->
