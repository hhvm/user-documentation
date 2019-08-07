``` yamlmeta
{
    "name": "getClosure",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/reflection/ext_reflection_hni.php",
        "api-sources/hhvm/hphp/hack/hhi/reflection.hhi"
    ],
    "class": "ReflectionMethod"
}
```




( excerpt from http://php




``` Hack
public function getClosure(
  $object = NULL,
): ?Closure;
```




net/manual/en/reflectionmethod.getclosure.php
)




Warning: This function is currently not documented; only its argument
list is available.




## Parameters




+ ` $object = NULL `




## Returns




* ` mixed ` - Returns Closure. Returns NULL in case of an error.
<!-- HHAPIDOC -->
