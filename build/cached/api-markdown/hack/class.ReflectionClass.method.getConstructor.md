``` yamlmeta
{
    "name": "getConstructor",
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
public function getConstructor(): ?ReflectionMethod;
```




net/manual/en/reflectionclass.getconstructor.php )




Gets the constructor of the reflected class.




## Returns




+ ` mixed ` - A ReflectionMethod object reflecting the class'
  constructor, or NULL if the class has no
  constructor.
<!-- HHAPIDOC -->
