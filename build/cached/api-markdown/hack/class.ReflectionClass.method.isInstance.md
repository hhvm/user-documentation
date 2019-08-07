``` yamlmeta
{
    "name": "isInstance",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/reflection/ext_reflection_hni.php",
        "api-sources/hhvm/hphp/hack/hhi/reflection.hhi"
    ],
    "class": "ReflectionClass"
}
```




( excerpt from http://php




``` Hack
public function isInstance(
  mixed $obj,
): bool;
```




net/manual/en/reflectionclass.isinstance.php )




Checks if an object is an instance of a class.




## Parameters




+ ` mixed $obj `




## Returns




* ` bool ` - Returns TRUE on success or FALSE on failure.
<!-- HHAPIDOC -->
