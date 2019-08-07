``` yamlmeta
{
    "name": "getInterfaceNames",
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
public function getInterfaceNames(): varray<string>;
```




net/manual/en/reflectionclass.getinterfacenames.php )




Get the interface names.




## Returns




+ ` mixed ` - A numerical array with interface names as the
  values.
<!-- HHAPIDOC -->
