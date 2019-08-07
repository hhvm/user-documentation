``` yamlmeta
{
    "name": "HH\\ExperimentalParserUtils\\find_method_names_in_concrete_derived_class",
    "sources": [
        "api-sources/hhvm/hphp/system/php/experimental_parser_utils.php"
    ]
}
```




``` Hack
namespace HH\ExperimentalParserUtils;

function find_method_names_in_concrete_derived_class(
  array $class_decl,
  ?string $namespace,
): vec<\tuple<string, string, string>>;
```




## Parameters




+ ` array $class_decl `
+ ` ?string $namespace `




## Returns




* ` vec<\tuple<string, string, string>> `
<!-- HHAPIDOC -->
