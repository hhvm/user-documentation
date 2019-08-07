``` yamlmeta
{
    "name": "gets",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/mcrouter/ext_mcrouter.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_mcrouter.hhi"
    ],
    "class": "MCRouter"
}
```




Retreive a record and its metadata







``` Hack
public function gets(
  string $key,
): Awaitable<array>;
```




## Parameters




+ ` string $key ` = Name of the key to retreive




## Returns




* ` array ` - - Value retreived and additional metadata
  array(
  'value' => 'Value retreived',
  'cas'   => 1234567890,
  'flags' => 0x12345678,
  )
<!-- HHAPIDOC -->
