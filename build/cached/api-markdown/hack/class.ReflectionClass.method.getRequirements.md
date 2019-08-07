``` yamlmeta
{
    "name": "getRequirements",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/reflection/ext_reflection_hni.php",
        "api-sources/hhvm/hphp/hack/hhi/reflection.hhi"
    ],
    "class": "ReflectionClass"
}
```




Gets ReflectionClass-es for the requirements of this class







``` Hack
public function getRequirements(): darray<string, ReflectionClass>;
```




## Returns




+ ` An ` - associative array of requirements, with keys as
  requirement names and the array values as ReflectionClass objects.
<!-- HHAPIDOC -->
