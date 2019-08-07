``` yamlmeta
{
    "name": "invoke",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/reflection/ext_reflection_hni.php",
        "api-sources/hhvm/hphp/hack/hhi/reflection.hhi"
    ],
    "class": "ReflectionMethod"
}
```




( excerpt from http://php




``` Hack
public function invoke(
  $obj,
  ...$args,
): mixed;
```




net/manual/en/reflectionmethod.invoke.php )




Invokes a reflected method.




## Parameters




+ ` $obj `
+ ` ...$args `




## Returns




* ` mixed ` - Returns the method result.
<!-- HHAPIDOC -->
