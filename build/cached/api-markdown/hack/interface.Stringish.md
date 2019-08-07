``` yamlmeta
{
    "name": "Stringish",
    "sources": [
        "api-sources/hhvm/hphp/system/php/lang/string.php",
        "api-sources/hhvm/hphp/hack/hhi/interfaces.hhi"
    ],
    "class": "Stringish"
}
```




Stringish is a type that matches strings as well as string-convertible
objects: that is, objects that provide the __toString method




## Interface Synopsis




``` Hack
interface Stringish implements XHPChild {...}
```




### Public Methods




+ [` ->__toString(): string `](</hack/reference/interface/Stringish/__toString/>)
<!-- HHAPIDOC -->
