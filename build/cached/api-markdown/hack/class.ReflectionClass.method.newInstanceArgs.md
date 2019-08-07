``` yamlmeta
{
    "name": "newInstanceArgs",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/reflection/ext_reflection_hni.php",
        "api-sources/hhvm/hphp/hack/hhi/reflection.hhi"
    ],
    "class": "ReflectionClass"
}
```




( excerpt from
http://php




``` Hack
public function newInstanceArgs(
  Traversable<mixed> $args = array (
),
);
```




net/manual/en/reflectionclass.newinstanceargs.php )




Creates a new instance of the class, the given arguments are passed to
the class constructor.




## Parameters




+ ` Traversable<mixed> $args = array ( ) `




## Returns




* ` mixed ` - Returns a new instance of the class.
<!-- HHAPIDOC -->
