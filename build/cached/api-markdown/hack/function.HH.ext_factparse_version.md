``` yamlmeta
{
    "name": "HH\\ext_factparse_version",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/factparse/ext_factparse.php",
        "api-sources/hhvm/hphp/hack/hhi/ext_factparse.hhi"
    ]
}
```




This should be bumped with every non-backwards compatible API change
1 => first version
2 => added $root argument to HH\\facts_parse()
3 => support requireExtends/requireImplements constraints




``` Hack
namespace HH;

function ext_factparse_version(): int;
```




## Returns




+ ` int `
<!-- HHAPIDOC -->
