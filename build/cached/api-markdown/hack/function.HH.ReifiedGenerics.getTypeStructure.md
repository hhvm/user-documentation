``` yamlmeta
{
    "name": "HH\\ReifiedGenerics\\getTypeStructure",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/hh/ext_hh.php",
        "api-sources/hhvm/hphp/hack/hhi/reified_generics.hhi"
    ]
}
```




Returns the type structure representation of the reified type




``` Hack
namespace HH\ReifiedGenerics;

function getTypeStructure<\T>(): TypeStructure<\T>;
```




## Returns




+ ` TypeStructure<\T> `
<!-- HHAPIDOC -->
