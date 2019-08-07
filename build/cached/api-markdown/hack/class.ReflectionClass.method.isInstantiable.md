``` yamlmeta
{
    "name": "isInstantiable",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/reflection/ext_reflection_hni.php",
        "api-sources/hhvm/hphp/hack/hhi/reflection.hhi"
    ],
    "class": "ReflectionClass"
}
```




( excerpt from
http://php




``` Hack
public function isInstantiable(): bool;
```




net/manual/en/reflectionclass.isinstantiable.php )




Checks if the class is instantiable.




## Returns




+ ` bool ` - Returns TRUE on success or FALSE on failure.
<!-- HHAPIDOC -->
