``` yamlmeta
{
    "name": "HH\\serialize_with_options",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/std/ext_std_variable.php"
    ]
}
```




``` Hack
namespace HH;

function serialize_with_options(
  \mixed $value,
  dict $options = dict [
],
): string;
```




## Parameters




+ ` \mixed $value `
+ ` dict $options = dict [ ] `




## Returns




* ` string `
<!-- HHAPIDOC -->
