``` yamlmeta
{
    "name": "getExtension",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/reflection/ext_reflection_hni.php",
        "api-sources/hhvm/hphp/hack/hhi/reflection.hhi"
    ],
    "class": "ReflectionClass"
}
```




( excerpt from http://php




``` Hack
public function getExtension(): ?ReflectionExtension;
```




net/manual/en/reflectionclass.getextension.php
)




Gets a ReflectionExtension object for the extension which defined the
class.




## Returns




+ ` mixed ` - A ReflectionExtension object representing the
  extension which defined the class, or NULL for
  user-defined classes.
<!-- HHAPIDOC -->
