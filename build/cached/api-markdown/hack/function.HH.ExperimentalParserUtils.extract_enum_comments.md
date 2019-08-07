``` yamlmeta
{
    "name": "HH\\ExperimentalParserUtils\\extract_enum_comments",
    "sources": [
        "api-sources/hhvm/hphp/system/php/experimental_parser_utils.php",
        "api-sources/hhvm/hphp/hack/hhi/experimental_parser_utils.hhi"
    ]
}
```




``` Hack
namespace HH\ExperimentalParserUtils;

function extract_enum_comments(
  array $enumerators,
): dict<string, vec<string>>;
```




## Parameters




+ ` array $enumerators `




## Returns




* ` dict<string, vec<string>> `
<!-- HHAPIDOC -->
