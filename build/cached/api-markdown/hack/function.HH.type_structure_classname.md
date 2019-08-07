``` yamlmeta
{
    "name": "HH\\type_structure_classname",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/reflection/ext_reflection-classes.php"
    ]
}
```




Retrieves the classname on the the TypeStructure pointed by a type
constant or a type alias




``` Hack
namespace HH;

function type_structure_classname(
  \mixed $cls_or_obj,
  ?string $cns_name = NULL,
): string;
```




## Parameters




+ ` \mixed $cls_or_obj `
+ ` ?string $cns_name = NULL `




## Returns




* ` string `
<!-- HHAPIDOC -->
