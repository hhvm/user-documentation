``` yamlmeta
{
    "name": "HH\\ExperimentalParserUtils\\find_all_functions",
    "sources": [
        "api-sources/hhvm/hphp/system/php/experimental_parser_utils.php",
        "api-sources/hhvm/hphp/hack/hhi/experimental_parser_utils.hhi"
    ]
}
```




``` Hack
namespace HH\ExperimentalParserUtils;

function find_all_functions(
  array $json,
): dict<int, array, FunctionNode>;
```




## Parameters




+ ` array $json `




## Returns




* ` dict<int, array, FunctionNode> `
<!-- HHAPIDOC -->
