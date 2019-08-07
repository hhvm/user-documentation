``` yamlmeta
{
    "name": "HH\\ExperimentalParserUtils\\find_boundary_token",
    "sources": [
        "api-sources/hhvm/hphp/system/php/experimental_parser_utils.php"
    ]
}
```




``` Hack
namespace HH\ExperimentalParserUtils;

function find_boundary_token(
  array $body,
  bool $right,
): ?\tuple<int, int>;
```




## Parameters




+ ` array $body `
+ ` bool $right `




## Returns




* ` ?\tuple<int, int> `
<!-- HHAPIDOC -->
