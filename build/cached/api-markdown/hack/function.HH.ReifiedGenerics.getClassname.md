``` yamlmeta
{
    "name": "HH\\ReifiedGenerics\\getClassname",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/hh/ext_hh.php",
        "api-sources/hhvm/hphp/hack/hhi/reified_generics.hhi"
    ]
}
```




Returns the name of the class represented by this reified type




``` Hack
namespace HH\ReifiedGenerics;

function getClassname<\T>(): \classname<\T>;
```




If this type does not represent a class, throws an exception




## Returns




+ ` \classname<\T> `
<!-- HHAPIDOC -->
