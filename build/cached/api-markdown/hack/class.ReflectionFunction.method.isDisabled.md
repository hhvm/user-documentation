``` yamlmeta
{
    "name": "isDisabled",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/reflection/ext_reflection_hni.php",
        "api-sources/hhvm/hphp/hack/hhi/reflection.hhi"
    ],
    "class": "ReflectionFunction"
}
```




( excerpt from
http://php




``` Hack
public function isDisabled(): bool;
```




net/manual/en/reflectionfunction.isdisabled.php )




Checks if the function is disabled, via the disable_functions directive.




## Returns




+ ` bool ` - TRUE if it's disable, otherwise FALSE
<!-- HHAPIDOC -->
