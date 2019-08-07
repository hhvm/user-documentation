``` yamlmeta
{
    "name": "HH\\ExperimentalParserUtils\\find_single_shape_type_alias",
    "sources": [
        "api-sources/hhvm/hphp/system/php/experimental_parser_utils.php",
        "api-sources/hhvm/hphp/hack/hhi/experimental_parser_utils.hhi"
    ]
}
```




``` Hack
namespace HH\ExperimentalParserUtils;

function find_single_shape_type_alias(
  array $json,
  string $name,
): ?\tuple<string, array, ShapeNode>;
```




## Parameters




+ ` array $json `
+ ` string $name `




## Returns




* ` ?\tuple<string, array, ShapeNode> `
<!-- HHAPIDOC -->
