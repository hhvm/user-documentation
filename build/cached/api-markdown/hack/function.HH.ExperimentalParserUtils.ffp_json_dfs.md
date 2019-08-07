``` yamlmeta
{
    "name": "HH\\ExperimentalParserUtils\\ffp_json_dfs",
    "sources": [
        "api-sources/hhvm/hphp/system/php/experimental_parser_utils.php"
    ]
}
```




``` Hack
namespace HH\ExperimentalParserUtils;

function ffp_json_dfs(
  \mixed $json,
  bool $right,
  \callable $predicate,
  \callable $skip_node = (($_) ==> false),
);
```




## Parameters




+ ` \mixed $json `
+ ` bool $right `
+ ` \callable $predicate `
+ ` \callable $skip_node = (($_) ==> false) `
<!-- HHAPIDOC -->
