``` yamlmeta
{
    "name": "getDefaultValueText",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/reflection/ext_reflection-classes.php",
        "api-sources/hhvm/hphp/hack/hhi/reflection.hhi"
    ],
    "class": "ReflectionParameter"
}
```




This is an HHVM only function that gets the raw text associated with
a default parameter




``` Hack
public function getDefaultValueText();
```




For example, for:
function foo($x = FOO*FOO)




"FOO*FOO" is returned.




getDefaultValue() will return the result of FOO*FOO.




## Returns




+ ` string ` - The raw text of a default value, or empty if it does not
  exist.
<!-- HHAPIDOC -->
