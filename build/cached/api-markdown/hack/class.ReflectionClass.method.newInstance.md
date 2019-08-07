``` yamlmeta
{
    "name": "newInstance",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/reflection/ext_reflection_hni.php",
        "api-sources/hhvm/hphp/hack/hhi/reflection.hhi"
    ],
    "class": "ReflectionClass"
}
```




( excerpt from http://php




``` Hack
public function newInstance(
  ...$args,
);
```




net/manual/en/reflectionclass.newinstance.php
)




Creates a new instance of the class. The given arguments are passed to
the class constructor.




## Parameters




+ ` ...$args `
<!-- HHAPIDOC -->
