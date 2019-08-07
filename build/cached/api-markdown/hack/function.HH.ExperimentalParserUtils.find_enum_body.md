``` yamlmeta
{
    "name": "HH\\ExperimentalParserUtils\\find_enum_body",
    "sources": [
        "api-sources/hhvm/hphp/system/php/experimental_parser_utils.php",
        "api-sources/hhvm/hphp/hack/hhi/experimental_parser_utils.hhi"
    ]
}
```




``` Hack
namespace HH\ExperimentalParserUtils;

function find_enum_body(
  array $json,
  string $name,
): ?array;
```




## Parameters




+ ` array $json `
+ ` string $name `




## Returns




* ` ?array `
<!-- HHAPIDOC -->
