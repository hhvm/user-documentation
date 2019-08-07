``` yamlmeta
{
    "name": "export",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/reflection/ext_reflection-classes.php",
        "api-sources/hhvm/hphp/hack/hhi/reflection.hhi"
    ],
    "class": "ReflectionParameter"
}
```




( excerpt from http://php




``` Hack
public static function export(
  $function,
  $parameter,
  $return = false,
);
```




net/manual/en/reflectionparameter.export.php )




Exports. Warning: This function is currently not documented; only its
argument list is available.




## Parameters




+ ` $function `
+ ` $parameter `
+ ` $return = false `




## Returns




* ` mixed ` - The exported reflection.
<!-- HHAPIDOC -->
