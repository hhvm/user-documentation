``` yamlmeta
{
    "name": "getFileName",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/reflection/ext_reflection_hni.php",
        "api-sources/hhvm/hphp/hack/hhi/reflection.hhi"
    ],
    "class": "ReflectionClass"
}
```




( excerpt from http://php




``` Hack
public function getFileName(): mixed;
```




net/manual/en/reflectionclass.getfilename.php
)




Gets the filename of the file in which the class has been defined.




## Returns




+ ` mixed ` - Returns the filename of the file in which the class
  has been defined. If the class is defined in the PHP
  core or in a PHP extension, FALSE is returned.
<!-- HHAPIDOC -->
