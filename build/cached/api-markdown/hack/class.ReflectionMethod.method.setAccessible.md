``` yamlmeta
{
    "name": "setAccessible",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/reflection/ext_reflection_hni.php",
        "api-sources/hhvm/hphp/hack/hhi/reflection.hhi"
    ],
    "class": "ReflectionMethod"
}
```




( excerpt from
http://php




``` Hack
public function setAccessible(
  bool $accessible,
): void;
```




net/manual/en/reflectionmethod.setaccessible.php )




Sets a method to be accessible. For example, it may allow protected and
private methods to be invoked.




## Parameters




+ ` bool $accessible `




## Returns




* ` mixed ` - No value is returned.
<!-- HHAPIDOC -->
