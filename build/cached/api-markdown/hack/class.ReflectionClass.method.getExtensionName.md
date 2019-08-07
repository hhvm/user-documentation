``` yamlmeta
{
    "name": "getExtensionName",
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
public function getExtensionName(): string;
```




net/manual/en/reflectionclass.getextensionname.php )




Gets the name of the extension which defined the class.




## Returns




+ ` mixed ` - The name of the extension which defined the class,
  or FALSE for user-defined classes.
<!-- HHAPIDOC -->
