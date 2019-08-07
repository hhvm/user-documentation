``` yamlmeta
{
    "name": "invokeArgs",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/reflection/ext_reflection_hni.php",
        "api-sources/hhvm/hphp/hack/hhi/reflection.hhi"
    ],
    "class": "ReflectionFunction"
}
```




( excerpt from
http://php




``` Hack
public function invokeArgs(
  varray $args,
);
```




net/manual/en/reflectionfunction.invokeargs.php )




Invokes the function and pass its arguments as array.




## Parameters




+ ` varray $args `




## Returns




* ` mixed ` - Returns the result of the invoked function
<!-- HHAPIDOC -->
