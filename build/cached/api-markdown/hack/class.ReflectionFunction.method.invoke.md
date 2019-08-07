``` yamlmeta
{
    "name": "invoke",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/reflection/ext_reflection_hni.php",
        "api-sources/hhvm/hphp/hack/hhi/reflection.hhi"
    ],
    "class": "ReflectionFunction"
}
```




( excerpt from http://php




``` Hack
public function invoke(
  ...$args,
);
```




net/manual/en/reflectionfunction.invoke.php )




Invokes a reflected function.




## Parameters




+ ` ...$args `




## Returns




* ` mixed ` - Returns the result of the invoked function call.
<!-- HHAPIDOC -->
