``` yamlmeta
{
    "name": "invokeArgs",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/reflection/ext_reflection_hni.php",
        "api-sources/hhvm/hphp/hack/hhi/reflection.hhi"
    ],
    "class": "ReflectionMethod"
}
```




( excerpt from http://php




``` Hack
public function invokeArgs(
  $obj,
  varray $args,
): mixed;
```




net/manual/en/reflectionmethod.invokeargs.php
)




Invokes the reflected method and pass its arguments as array.




## Parameters




+ ` $obj `
+ ` varray $args `




## Returns




* ` mixed ` - Returns the method result.
<!-- HHAPIDOC -->
