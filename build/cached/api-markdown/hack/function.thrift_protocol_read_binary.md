``` yamlmeta
{
    "name": "thrift_protocol_read_binary",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/thrift/ext_thrift.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_thrift.hhi"
    ]
}
```




``` Hack
function thrift_protocol_read_binary(
  object $transportobj,
  string $obj_typename,
  bool $strict_read,
): object;
```




## Parameters




+ ` object $transportobj `
+ ` string $obj_typename `
+ ` bool $strict_read `




## Returns




* ` object `
<!-- HHAPIDOC -->
