``` yamlmeta
{
    "name": "export",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/reflection/ext_reflection_hni.php",
        "api-sources/hhvm/hphp/hack/hhi/reflection.hhi"
    ],
    "class": "ReflectionFunction"
}
```




( excerpt from http://php




``` Hack
public static function export(
  $name,
  $return = false,
);
```




net/manual/en/reflectionfunction.export.php )




Exports a Reflected function.




## Parameters




+ ` $name `
+ ` $return = false `




## Returns




* ` mixed ` - If the return parameter is set to TRUE, then the
  export is returned as a string, otherwise NULL is
  returned.
<!-- HHAPIDOC -->
