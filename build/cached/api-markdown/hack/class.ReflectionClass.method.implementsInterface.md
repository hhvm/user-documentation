``` yamlmeta
{
    "name": "implementsInterface",
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
public function implementsInterface(
  string $interface,
): bool;
```




net/manual/en/reflectionclass.implementsinterface.php )




Checks whether it implements an interface.




## Parameters




+ ` string $interface `




## Returns




* ` bool ` - Returns TRUE on success or FALSE on failure.
<!-- HHAPIDOC -->
