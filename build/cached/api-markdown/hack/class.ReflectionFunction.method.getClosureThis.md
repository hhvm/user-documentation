``` yamlmeta
{
    "name": "getClosureThis",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/reflection/ext_reflection_hni.php",
        "api-sources/hhvm/hphp/hack/hhi/reflection.hhi"
    ],
    "class": "ReflectionFunction"
}
```




Returns this pointer bound to closure




``` Hack
public function getClosureThis(): mixed;
```




## Returns




+ ` object|NULL ` - Returns $this pointer. Returns NULL in case of
  an error.
<!-- HHAPIDOC -->
