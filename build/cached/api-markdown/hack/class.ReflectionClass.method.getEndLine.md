``` yamlmeta
{
    "name": "getEndLine",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/reflection/ext_reflection_hni.php",
        "api-sources/hhvm/hphp/hack/hhi/reflection.hhi"
    ],
    "class": "ReflectionClass"
}
```




( excerpt from http://php




``` Hack
public function getEndLine(): int;
```




net/manual/en/reflectionclass.getendline.php )




Gets end line number from a user-defined class definition.




## Returns




+ ` int ` - The ending line number of the user defined class, or
  FALSE if unknown.
<!-- HHAPIDOC -->
