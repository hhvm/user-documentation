``` yamlmeta
{
    "name": "thrift_protocol_write_compact",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/thrift/ext_thrift.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_thrift.hhi"
    ]
}
```




``` Hack
function thrift_protocol_write_compact(
  object $transportobj,
  string $method_name,
  int $msgtype,
  object $request_struct,
  int $seqid,
  bool $oneway = false,
): void;
```




## Parameters




+ ` object $transportobj `
+ ` string $method_name `
+ ` int $msgtype `
+ ` object $request_struct `
+ ` int $seqid `
+ ` bool $oneway = false `




## Returns




* ` void `
<!-- HHAPIDOC -->
