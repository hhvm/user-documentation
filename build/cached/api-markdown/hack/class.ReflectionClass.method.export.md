``` yamlmeta
{
    "name": "export",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/reflection/ext_reflection_hni.php",
        "api-sources/hhvm/hphp/hack/hhi/reflection.hhi"
    ],
    "class": "ReflectionClass"
}
```




( excerpt from http://php




``` Hack
public static function export(
  mixed $argument,
  bool $return = false,
): ?string;
```




net/manual/en/reflectionclass.export.php )




Exports a reflected class.




## Parameters




+ ` mixed $argument `
+ ` bool $return = false `




## Returns




* ` mixed ` - If the return parameter is set to TRUE, then the
  export is returned as a string, otherwise NULL is
  returned.
<!-- HHAPIDOC -->
