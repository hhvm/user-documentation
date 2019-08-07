``` yamlmeta
{
    "name": "isInternal",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/reflection/ext_reflection_hni.php",
        "api-sources/hhvm/hphp/hack/hhi/reflection.hhi"
    ],
    "class": "ReflectionClass"
}
```




( excerpt from http://php




``` Hack
public function isInternal(): bool;
```




net/manual/en/reflectionclass.isinternal.php )




Checks if the class is defined internally by an extension, or the core,
as opposed to user-defined.




## Returns




+ ` bool ` - Returns TRUE on success or FALSE on failure.
<!-- HHAPIDOC -->
