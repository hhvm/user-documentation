``` yamlmeta
{
    "name": "canBePassedByValue",
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
public function canBePassedByValue();
```




net/manual/en/reflectionparameter.canbepassedbyvalue.php )




Returns whether this parameter can be passed by value. Warning: This
function is currently not documented; only its argument list is
available.




## Returns




+ ` mixed ` - Returns TRUE if the parameter can be passed by value,
  FALSE otherwise. Returns NULL in case of an error.
<!-- HHAPIDOC -->
