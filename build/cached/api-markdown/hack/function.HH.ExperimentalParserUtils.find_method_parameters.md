``` yamlmeta
{
    "name": "HH\\ExperimentalParserUtils\\find_method_parameters",
    "sources": [
        "api-sources/hhvm/hphp/system/php/experimental_parser_utils.php",
        "api-sources/hhvm/hphp/hack/hhi/experimental_parser_utils.hhi"
    ]
}
```




Instead of doing a full recursion like the lambda extractor, this function
can do a shallow search of the tree to collect methods by name




``` Hack
namespace HH\ExperimentalParserUtils;

function find_method_parameters(
  array $json,
  string $method_name,
  int $line_number,
): array;
```




If there is a tie, use the line number




## Parameters




+ ` array $json `
+ ` string $method_name `
+ ` int $line_number `




## Returns




* ` array `
<!-- HHAPIDOC -->
