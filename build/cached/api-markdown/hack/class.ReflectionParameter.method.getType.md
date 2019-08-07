``` yamlmeta
{
    "name": "getType",
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
public function getType(): ?ReflectionType;
```




net/manual/en/reflectionparameter.gettype.php )




Gets the associated type of a parameter.




## Returns




+ ` ?ReflectionType ` - Returns a ReflectionType object if a
  parameter type is specified, NULL otherwise.
<!-- HHAPIDOC -->
