``` yamlmeta
{
    "name": "HH\\ExperimentalParserUtils\\extract_type_of_only_shape_type_alias",
    "sources": [
        "api-sources/hhvm/hphp/system/php/experimental_parser_utils.php",
        "api-sources/hhvm/hphp/hack/hhi/experimental_parser_utils.hhi"
    ]
}
```




``` Hack
namespace HH\ExperimentalParserUtils;

function extract_type_of_only_shape_type_alias(
  array $json,
): dict<string, \tuple<string, bool>>;
```




## Parameters




+ ` array $json `




## Returns




* ` dict<string, \tuple<string, bool>> `
<!-- HHAPIDOC -->
