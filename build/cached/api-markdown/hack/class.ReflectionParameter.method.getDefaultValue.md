``` yamlmeta
{
    "name": "getDefaultValue",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/reflection/ext_reflection-classes.php",
        "api-sources/hhvm/hphp/hack/hhi/reflection.hhi"
    ],
    "class": "ReflectionParameter"
}
```




( excerpt from
http://php




``` Hack
public function getDefaultValue();
```




net/manual/en/reflectionparameter.getdefaultvalue.php )




Gets the default value of the parameter for a user-defined function or
method. If the parameter is not optional a ReflectionException will be
thrown.




## Returns




+ ` mixed ` - The parameters default value.
<!-- HHAPIDOC -->
