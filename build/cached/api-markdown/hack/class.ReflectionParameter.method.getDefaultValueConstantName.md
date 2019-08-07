``` yamlmeta
{
    "name": "getDefaultValueConstantName",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/reflection/ext_reflection-classes.php",
        "api-sources/hhvm/hphp/hack/hhi/reflection.hhi"
    ],
    "class": "ReflectionParameter"
}
```




( excerpt from
php




``` Hack
public function getDefaultValueConstantName();
```




net/manual/en/reflectionparameter.getdefaultvalueconstantname.php
)




Returns the default value's constant name if default value is constant or
null




## Returns




+ ` mixed ` - Returns string on success or NULL on failure.
<!-- HHAPIDOC -->
