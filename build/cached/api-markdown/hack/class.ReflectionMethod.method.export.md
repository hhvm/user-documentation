``` yamlmeta
{
    "name": "export",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/reflection/ext_reflection_hni.php",
        "api-sources/hhvm/hphp/hack/hhi/reflection.hhi"
    ],
    "class": "ReflectionMethod"
}
```




( excerpt from http://php




``` Hack
public static function export(
  string $class,
  string $name,
  bool $return = false,
): ?string;
```




net/manual/en/reflectionmethod.export.php )




Exports a ReflectionMethod. Warning: This function is currently not
documented; only its argument list is available.




## Parameters




+ ` string $class `
+ ` string $name `
+ ` bool $return = false `




## Returns




* ` ?string ` - If the return parameter is set to TRUE, then the
  export is returned as a string, otherwise NULL is
  returned.
<!-- HHAPIDOC -->
