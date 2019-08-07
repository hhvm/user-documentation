``` yamlmeta
{
    "name": "HH\\ExperimentalParserUtils\\extract_parameter_comments",
    "sources": [
        "api-sources/hhvm/hphp/system/php/experimental_parser_utils.php",
        "api-sources/hhvm/hphp/hack/hhi/experimental_parser_utils.hhi"
    ]
}
```




``` Hack
namespace HH\ExperimentalParserUtils;

function extract_parameter_comments(
  array $params,
): dict<string, vec<string>>;
```




## Parameters




+ ` array $params `




## Returns




* ` dict<string, vec<string>> `
<!-- HHAPIDOC -->
