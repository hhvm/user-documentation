``` yamlmeta
{
    "name": "isDefaultValueConstant",
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
public function isDefaultValueConstant(): ?bool;
```




net/manual/en/reflectionparameter.isdefaultvalueconstant.php )




Returns TRUE if the default value is constant, FALSE if it is not or
NULL on failure.




## Returns




+ ` bool ` - If parameters default value is constant, or NULL if
  a default value does not exist.
<!-- HHAPIDOC -->
