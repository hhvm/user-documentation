``` yamlmeta
{
    "name": "HH\\ExperimentalParserUtils\\find_class_method_shape_return_type",
    "sources": [
        "api-sources/hhvm/hphp/system/php/experimental_parser_utils.php",
        "api-sources/hhvm/hphp/hack/hhi/experimental_parser_utils.hhi"
    ]
}
```




``` Hack
namespace HH\ExperimentalParserUtils;

function find_class_method_shape_return_type(
  array $class_body,
  string $name,
): ?array;
```




## Parameters




+ ` array $class_body `
+ ` string $name `




## Returns




* ` ?array `
<!-- HHAPIDOC -->
