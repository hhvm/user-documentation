``` yamlmeta
{
    "name": "HH\\ExperimentalParserUtils\\extract_shape_comments",
    "sources": [
        "api-sources/hhvm/hphp/system/php/experimental_parser_utils.php",
        "api-sources/hhvm/hphp/hack/hhi/experimental_parser_utils.hhi"
    ]
}
```




``` Hack
namespace HH\ExperimentalParserUtils;

function extract_shape_comments(
  array $shape,
): dict<string, vec<string>>;
```




## Parameters




+ ` array $shape `




## Returns




* ` dict<string, vec<string>> `
<!-- HHAPIDOC -->
