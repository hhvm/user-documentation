``` yamlmeta
{
    "name": "HH\\ExperimentalParserUtils\\find_test_methods",
    "sources": [
        "api-sources/hhvm/hphp/system/php/experimental_parser_utils.php"
    ]
}
```




``` Hack
namespace HH\ExperimentalParserUtils;

function find_test_methods(
  array $json,
): vec<\tuple<string, string, string>>;
```




## Parameters




+ ` array $json `




## Returns




* ` vec<\tuple<string, string, string>> `
<!-- HHAPIDOC -->
