``` yamlmeta
{
    "name": "isPassedByReference",
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
public function isPassedByReference();
```




net/manual/en/reflectionparameter.ispassedbyreference.php )




Checks if the parameter is passed in by reference. Warning: This
function is currently not documented; only its argument list is
available.




## Returns




+ ` mixed ` - TRUE if the parameter is passed in by reference,
  otherwise FALSE
<!-- HHAPIDOC -->
