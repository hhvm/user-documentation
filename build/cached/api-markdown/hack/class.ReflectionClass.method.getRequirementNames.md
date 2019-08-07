``` yamlmeta
{
    "name": "getRequirementNames",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/reflection/ext_reflection_hni.php",
        "api-sources/hhvm/hphp/hack/hhi/reflection.hhi"
    ],
    "class": "ReflectionClass"
}
```




Gets the list of implemented interfaces/inherited classes needed to
implement an interface / use a trait




``` Hack
public function getRequirementNames(): varray<string>;
```




Empty array for abstract and
concrete classes.




## Returns




+ ` varray<string> `
<!-- HHAPIDOC -->
