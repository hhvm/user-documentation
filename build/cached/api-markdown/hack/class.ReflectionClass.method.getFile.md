``` yamlmeta
{
    "name": "getFile",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/reflection/ext_reflection_hni.php",
        "api-sources/hhvm/hphp/hack/hhi/reflection.hhi"
    ],
    "class": "ReflectionClass"
}
```




Gets the declaring file for the reflected class




``` Hack
public function getFile(): ReflectionFile;
```




## Returns




+ ` ReflectionFile ` - A ReflectionFile object of the file that the
  reflected class is part of.
<!-- HHAPIDOC -->
